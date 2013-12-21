<?php
// Copyright (c) 2013 Datenstrom, http://datenstrom.se
// This file may be used and distributed under the terms of the public license.

// Command line core plugin
class YellowCommandline
{
	const Version = "0.2.2";
	var $yellow;			//access to API

	// Initialise plugin
	function onLoad($yellow)
	{
		$this->yellow = $yellow;
		$this->yellow->config->setDefault("commandBuildDefaultFile", "index.html");
		$this->yellow->config->setDefault("commandBuildCustomMediaExtension", ".txt");
		$this->yellow->config->setDefault("commandBuildCustomErrorFile", "error404.html");
	}
	
	// Handle command help
	function onCommandHelp()
	{
		$help .= "version\n";
		$help .= "build DIRECTORY [LOCATION]\n";
		return $help;
	}
	
	// Handle command
	function onCommand($args)
	{
		list($name, $command) = $args;
		switch($command)
		{
			case "":		$statusCode = $this->helpCommand(); break;
			case "version":	$statusCode = $this->versionCommand(); break;
			case "build":	$statusCode = $this->buildCommand($args); break;
			default:		$statusCode = $this->pluginCommand($args); break;
		}
		return $statusCode;
	}
	
	// Show available commands
	function helpCommand()
	{
		echo "Yellow command line ".YellowCommandline::Version."\n";
		foreach($this->getCommandHelp() as $line) echo (++$lineCounter>1 ? "        " : "Syntax: ")."yellow.php $line\n";
		return 200;
	}
	
	// Show software version
	function versionCommand()
	{
		echo "Yellow ".Yellow::Version."\n";
		foreach($this->yellow->plugins->plugins as $key=>$value) echo "$value[class] $value[version]\n";
		return 200;
	}
	
	// Build website
	function buildCommand($args)
	{
		$statusCode = 0;
		list($dummy, $command, $path, $location) = $args;
		if(!empty($path) && $path!="/")
		{
			if($this->yellow->config->isExisting("serverName"))
			{
				$serverName = $this->yellow->config->get("serverName");
				$serverBase = $this->yellow->config->get("serverBase");
				list($statusCode, $content, $media, $system, $error) = $this->buildStatic($serverName, $serverBase, $location, $path);
			} else {
				list($statusCode, $content, $media, $system, $error) = array(500, 0, 0, 0, 1);
				$fileName = $this->yellow->config->get("configDir").$this->yellow->config->get("configFile");
				echo "ERROR bulding website: Please configure serverName and serverBase in file '$fileName'!\n";
			}
			echo "Yellow $command: $content content, $media media, $system system";
			echo ", $error error".($error!=1 ? 's' : '');
			echo ", status $statusCode\n";
		} else {
			echo "Yellow $command: Invalid arguments\n";
			$statusCode = 400;
		}
		return $statusCode;
	}
	
	// Build static files
	function buildStatic($serverName, $serverBase, $location, $path)
	{
		$this->yellow->toolbox->timerStart($time);
		$statusCodeMax = $error = 0;
		if(empty($location))
		{
			$pages = $this->yellow->pages->index(true);
			$fileNamesMedia = $this->yellow->toolbox->getDirectoryEntriesrecursive(
				$this->yellow->config->get("mediaDir"), "/.*/", false, false);
			$fileNamesMedia = array_merge($fileNamesMedia, $this->yellow->toolbox->getDirectoryEntries(
				".", "/.*\\".$this->yellow->config->get("commandBuildCustomMediaExtension")."/", false, false));
			$fileNamesSystem = array($this->yellow->config->get("commandBuildCustomErrorFile"));
		} else {
			if($location[0] != '/') $location = '/'.$location;
			$pages = new YellowPageCollection($this->yellow);
			$pages->append(new YellowPage($this->yellow, $location));
			$fileNamesMedia = array();
			$fileNamesSystem = array();
		}
		foreach($pages as $page)
		{
			$statusCode = $this->buildStaticLocation($serverName, $serverBase, $page->location, $path);
			$statusCodeMax = max($statusCodeMax, $statusCode);
			if($statusCode >= 400)
			{
				++$error;
				echo "ERROR building location '".$page->location."', ".$this->yellow->page->getStatusCode(true)."\n";
			}
			if(defined("DEBUG") && DEBUG>=1) echo "YellowCommandline::buildStatic status:$statusCode location:".$page->location."\n";
		}
		foreach($fileNamesMedia as $fileName)
		{
			$statusCode = $this->copyStaticFile($fileName, "$path/$fileName") ? 200 : 500;
			$statusCodeMax = max($statusCodeMax, $statusCode);
			if($statusCode >= 400)
			{
				++$error;
				echo "ERROR building media file '$path/$fileName', ".$this->yellow->toolbox->getHttpStatusFormatted($statusCode)."\n";
			}
			if(defined("DEBUG") && DEBUG>=1) echo "YellowCommandline::buildStatic status:$statusCode file:$fileName\n";
		}
		foreach($fileNamesSystem as $fileName)
		{
			$statusCode = $this->buildStaticError($serverName, $serverBase, "$path/$fileName", 404) ? 200 : 500;
			$statusCodeMax = max($statusCodeMax, $statusCode);
			if($statusCode >= 400)
			{
				++$error;
				echo "ERROR building system file '$path/$fileName', ".$this->yellow->toolbox->getHttpStatusFormatted($statusCode)."\n";
			}
			if(defined("DEBUG") && DEBUG>=1) echo "YellowCommandline::buildStatic status:$statusCode file:$fileName\n";
		}
		$this->yellow->toolbox->timerStop($time);
		if(defined("DEBUG") && DEBUG>=1) echo "YellowCommandline::buildStatic time:$time ms\n";
		return array($statusCodeMax, count($pages), count($fileNamesMedia), count($fileNamesSystem), $error);
	}
	
	// Build static location as file
	function buildStaticLocation($serverName, $serverBase, $location, $path)
	{		
		ob_start();
		$_SERVER["SERVER_PROTOCOL"] = "HTTP/1.1";
		$_SERVER["SERVER_NAME"] = $serverName;
		$_SERVER["REQUEST_URI"] = $serverBase.$location;
		$_SERVER["SCRIPT_NAME"] = $serverBase."yellow.php";
		$statusCode = $this->yellow->request();
		if($statusCode != 404)
		{
			$fileOk = true;
			$modified = strtotime($this->yellow->page->getHeader("Last-Modified"));
			list($contentType, $contentEncoding) = explode(';', $this->yellow->page->getHeader("Content-Type"), 2);
			$staticLocation = $this->getStaticLocation($location, $contentType);
			if($location == $staticLocation)
			{
				$fileName = $this->getStaticFileName($location, $path);
				$fileData = ob_get_contents();
				if($statusCode>=301 && $statusCode<=303) $fileData = $this->getStaticRedirect($this->yellow->page->getHeader("Location"));
				$fileOk = $this->createStaticFile($fileName, $fileData, $modified);
			} else {
				if(!$this->yellow->toolbox->isFileLocation($location))
				{
					$fileName = $this->getStaticFileName($location, $path);
					$fileData = $this->getStaticRedirect("http://$serverName$serverBase$staticLocation");
					$fileOk = $this->createStaticFile($fileName, $fileData, $modified);
					if($fileOk)
					{
						$fileName = $this->getStaticFileName($staticLocation, $path);
						$fileData = ob_get_contents();
						$fileOk = $this->createStaticFile($fileName, $fileData, $modified);
					}
				} else {
					$statusCode = 409;
					$this->yellow->page->error($statusCode, "Type '$contentType' does not match file name!");
				}
			}
			if(!$fileOk)
			{
				$statusCode = 500;
				$this->yellow->page->error($statusCode, "Can't write file '$fileName'!");
			}
		}
		ob_end_clean();
		return $statusCode;
	}
	
	// Build static error as file
	function buildStaticError($serverName, $serverBase, $fileName, $statusCodeRequest)
	{
		ob_start();
		$_SERVER["SERVER_PROTOCOL"] = "HTTP/1.1";
		$_SERVER["SERVER_NAME"] = $serverName;
		$_SERVER["REQUEST_URI"] = $serverBase."/";
		$_SERVER["SCRIPT_NAME"] = $serverBase."yellow.php";
		$statusCode = $this->yellow->request($statusCodeRequest);
		if($statusCode == $statusCodeRequest)
		{
			$modified = strtotime($this->yellow->page->getHeader("Last-Modified"));			
			if(!$this->createStaticFile($fileName, ob_get_contents(), $modified))
			{
				$statusCode = 500;
				$this->yellow->page->error($statusCode, "Can't write file '$fileName'!");
			}
		}
		ob_end_clean();
		return $statusCode == $statusCodeRequest;
	}
	
	// Create static file
	function createStaticFile($fileName, $fileData, $modified)
	{
		return $this->yellow->toolbox->createFile($fileName, $fileData, true) &&
			$this->yellow->toolbox->modifyFile($fileName, $modified);
	}
	
	// Copy static file
	function copyStaticFile($fileNameSource, $fileNameDest)
	{
		return $this->yellow->toolbox->copyFile($fileNameSource, $fileNameDest, true) &&
			$this->yellow->toolbox->modifyFile($fileNameDest, filemtime($fileNameSource));
	}
	
	// Return static location corresponding to content type
	function getStaticLocation($location, $contentType)
	{
		if(!empty($contentType))
		{
			$extension = ($pos = strrposu($location, '.')) ? substru($location, $pos) : "";
			if($contentType == "text/html")
			{
				if($this->yellow->toolbox->isFileLocation($location))
				{
					if(!empty($extension) && $extension!=".html") $location .= ".html";
				}
			} else {
				if($this->yellow->toolbox->isFileLocation($location))
				{
					if(empty($extension)) $location .= ".unknown";
				} else {
					if(preg_match("/^(\w+)\/(\w+)/", $contentType, $matches)) $extension = ".$matches[2]";
					$location .= "index$extension";
				}
			}
		}
		return $location;
	}
	
	// Return static file name from location
	function getStaticFileName($location, $path)
	{
		$fileName = $path.$location;
		if(!$this->yellow->toolbox->isFileLocation($location))
		{
			$fileName .= $this->yellow->config->get("commandBuildDefaultFile");
		}
		return $fileName;
	}
	
	// Return static redirect data
	function getStaticRedirect($url)
	{
		$text  = "<!DOCTYPE html><html>\n";
		$text .= "<head>\n";
		$text .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />\n";
		$text .= "<meta http-equiv=\"refresh\" content=\"0;url=$url\" />\n";
		$text .= "</head>\n";
		$text .= "</html>\n";
		return $text;
	}
	
	// Return command help
	function getCommandHelp()
	{
		$data = array();
		foreach($this->yellow->plugins->plugins as $key=>$value)
		{
			if(method_exists($value["obj"], "onCommandHelp"))
			{
				foreach(preg_split("/[\r\n]+/", $value["obj"]->onCommandHelp()) as $line)
				{
					list($command, $text) = explode(' ', $line, 2);
					if(!empty($command) && is_null($data[$command])) $data[$command] = $line;
				}
			}
		}
		uksort($data, strnatcasecmp);
		return $data;
	}
	
	// Forward plugin command
	function pluginCommand($args)
	{
		$statusCode = 0;
		foreach($this->yellow->plugins->plugins as $key=>$value)
		{
			if($key == "commandline") continue;
			if(method_exists($value["obj"], "onCommand"))
			{
				$statusCode = $value["obj"]->onCommand($args);
				if($statusCode != 0) break;
			}
		}
		return $statusCode;
	}
}
	
$yellow->registerPlugin("commandline", "YellowCommandline", YellowCommandline::Version);
?>