<?php
// Swedish extension, https://github.com/annaesvensson/yellow-language/tree/main/translations/swedish

class YellowSwedish {
    const VERSION = "0.8.42";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->language->setDefaults(array(
            "Language: sv",
            "LanguageLocale: sv_SE",
            "LanguageDescription: Svenska",
            "LanguageTranslator: Anna Svensson",
            "AudioDescription: HTML5 ljudspelare.",
            "BerlinDescription: Berlin är ett tema inspirerat av Dieter Rams.",
            "BlogDescription: Blogg för din webbplats.",
            "BlogBy: av",
            "BlogTag: Taggar:",
            "BlogMore: Läs mer…",
            "BreadcrumbDescription: Brödcrumbnavigering.",
            "BreadcrumbNavigation: Brödcrumb",
            "BundleDescription: Bundla webbplatsfiler.",
            "ChineseDescription: Kinesiska språket.",
            "CodefileDescription: Ladda ner kodblock som textfil.",
            "CommandDescription: Webbplatsens kommandorad.",
            "ContactDescription: E-post kontaktsida.",
            "ContactName: Namn:",
            "ContactEmail: Email:",
            "ContactMessage: Meddelande:",
            "ContactConsent: Jag godkänner att mitt meddelande lagras av denna webbplats.",
            "ContactButton: Skicka mitt meddelande",
            "ContactMailSpam: [Spam]",
            "ContactMailHeader: Du har fått ett meddelande av @sender:",
            "ContactMailFooter: Detta mail skickades via @sitename - @title",
            "ContactStatusNone: Säg hej. Din feedback är väldigt välkommen.",
            "ContactStatusIncomplete: Vänligen fyll i alla fält.",
            "ContactStatusInvalid: Vänligen ange en giltig emailadress.",
            "ContactStatusReview: Vänligen ta bort länkar från meddelandet.",
            "ContactStatusDone: Ditt mail har nu skickats. Tack!",
            "ContactStatusError: Mailet kunde inte skickas, vänligen försök igen senare!",
            "CopenhagenDescription: Copenhagen är ett vackert tema.",
            "CoreDescription: Webbplatsens kärnfunktion.",
            "CoreNavigation: Huvud",
            "CorePagination: Sidbyte",
            "CorePaginationPrevious: ← Tidigare",
            "CorePaginationNext: Nästa →",
            "CoreTimeFormatShort: H:i",
            "CoreTimeFormatMedium: H:i:s",
            "CoreTimeFormatLong: H:i:s T",
            "CoreDateFormatShort: F Y",
            "CoreDateFormatMedium: Y-m-d",
            "CoreDateFormatLong: Y-m-d H:i",
            "CoreDatePast: idag, igår, @x dagar sedan, en månad sedan, @x månader sedan, ett år sedan, @x år sedan, den @x",
            "CoreDateFuture: snart, imorgon, om @x dagar, om 1 månad, om @x månader, om 1 år, om @x år, den @x",
            "CoreDateMonthsNominative: Januari, Februari, Mars, April, Maj, Juni, Juli, Augusti, September, Oktober, November, December",
            "CoreDateMonthsGenitive: Januari, Februari, Mars, April, Maj, Juni, Juli, Augusti, September, Oktober, November, December",
            "CoreDateWeekdays: Måndag, Tisdag, Onsdag, Torsdag, Fredag, Lördag, Söndag",
            "CoreDateWeekstart: Måndag",
            "CoreDecimalSeparator: ,",
            "CoreError404Title: Filen hittades inte",
            "CoreError404Text: Den begärda filen kunde inte hittas. Å nej...",
            "CoreError420Title: Sidan är inte offentlig",
            "CoreError420Text: Den begärda sidan är inte offentlig. [yellow error]",
            "CoreError430Title: Inloggningen misslyckades",
            "CoreError430Text: Emailen eller lösenordet är felaktigt. [Var god försök igen](#data-action-login).",
            "CoreError434Title: Sidan hittades inte",
            "CoreError434Text: Den begärda sidan kunde inte hittas. [Du kan skapa den här sidan](#data-action-edit).",
            "CoreError435Title: Sidan hittades inte",
            "CoreError435Text: Den begärda sidan har tagits bort. [Du kan återställa den här sidan](#data-action-restore).",
            "CoreError450Title: Uppdateringsfel",
            "CoreError450Text: Kan inte ansluta till uppdateringsservern. En internetanslutning krävs.",
            "CoreError500Title: Serverfel",
            "CoreError500Text: Något gick fel. [yellow error]",
            "CsvDescription: CSV-filtolkare.",
            "CzechDescription: Tjeckiska språket.",
            "DailyDescription: Visa dagliga sidor.",
            "DanishDescription: Danska språket.",
            "DisqusDescription: Visa Disqus-kommentarer på bloggen.",
            "DraftDescription: Stöd för draftsidor.",
            "DraftPageError: Vänligen logga in.",
            "DutchDescription: Nederländska språket.",
            "EditDescription: Redigera din webbplats i en webbläsare.",
            "EditLoginTitle: Välkommen",
            "EditLoginEmail: Email:",
            "EditLoginPassword: Lösenord:",
            "EditLoginForgot: Glömt lösenordet?",
            "EditLoginSignup: Skapa användarkonto?",
            "EditLoginButton: Logga in",
            "EditSignupTitle: Create user account",
            "EditSignupName: Namn:",
            "EditSignupEmail: Email:",
            "EditSignupPassword: Lösenord:",
            "EditSignupConsent: Jag godkänner att mina personuppgifter lagras på denna webbplats.",
            "EditSignupButton: Create",
            "EditSignupStatusNone: Here you can create a new user account.",
            "EditSignupStatusIncomplete: Please fill out all fields.",
            "EditSignupStatusInvalid: Please enter a valid email.",
            "EditSignupStatusWeak: Please enter a different password.",
            "EditSignupStatusShort: Please enter a longer password.",
            "EditSignupStatusNext: User account will be created, please check your emails.",
            "EditForgotTitle: Forgot your password",
            "EditForgotEmail: Email:",
            "EditForgotStatusNone: No problem, you can create a new password.",
            "EditForgotStatusInvalid: Please enter a valid email.",
            "EditForgotStatusNext: User account will be recovered, please check your emails.",
            "EditRecoverTitle: Forgot your password",
            "EditRecoverPassword: Password:",
            "EditRecoverStatusPassword: Please enter a new password.",
            "EditRecoverStatusWeak: Please enter a different password.",
            "EditRecoverStatusShort: Please enter a longer password.",
            "EditRecoverStatusDone: User account recovered. Thank you!",
            "EditConfirmSubject: Confirm user account",
            "EditConfirmMessage: Hi @usershort,\\n\\nplease confirm your user account. Click the following link.",
            "EditConfirmTitle: User account",
            "EditConfirmStatusDone: User account confirmed and waiting for approval. Thank you!",
            "EditApproveSubject: Approve user account",
            "EditApproveMessage: Hi @usershort,\\n\\nplease approve a new user account for @useraccount. Click the following link.",
            "EditApproveTitle: User account",
            "EditApproveStatusDone: User account approved. Thank you!",
            "EditReactivateSubject: Reactivate user account",
            "EditReactivateMessage: Hi @usershort,\\n\\nplease reactivate your user account. There were too many failed login attempts. Click the following link.",
            "EditReactivateTitle: User account",
            "EditReactivateStatusDone: User account reactivated. Thank you!",
            "EditVerifySubject: Change user account",
            "EditVerifyMessage: Hi @usershort,\\n\\nplease confirm a new email for your user account. Click the following link.",
            "EditVerifyTitle: User account",
            "EditVerifyStatusDone: User account changed. Thank you!",
            "EditChangeSubject: Change user account",
            "EditChangeMessage: Hi @usershort,\\n\\nplease confirm that you want to change your user account. Click the following link.",
            "EditChangeTitle: User account",
            "EditChangeStatusDone: User account changed. Thank you!",
            "EditRemoveSubject: Delete user account",
            "EditRemoveMessage: Hi @usershort,\\n\\nplease confirm that you want to delete your user account. Click the following link.",
            "EditRemoveTitle: User account",
            "EditRemoveStatusDone: User account deleted. Thank you!",
            "EditRecoverSubject: Recover user account",
            "EditRecoverMessage: Hi @usershort,\\n\\nplease confirm that you forgot your password. Click the following link.",
            "EditWelcomeSubject: Welcome",
            "EditWelcomeMessage: Hi @usershort,\\n\\nyour user account has been created. Have fun editing the website.",
            "EditGoodbyeSubject: Goodbye",
            "EditGoodbyeMessage: Hi @usershort,\\n\\nyour user account has been deleted. Take care.",
            "EditAccountTitle: Användare",
            "EditAccountInformation: Du kan radera ditt användarkonto.",
            "EditAccountMore: Läs mer…",
            "EditAccountStatusNone: Här kan du ändra ditt användarkonto.",
            "EditAccountStatusInvalid: Please enter a valid email.",
            "EditAccountStatusTaken: Please enter a different email.",
            "EditAccountStatusWeak: Please enter a different password.",
            "EditAccountStatusShort: Please enter a longer password.",
            "EditAccountStatusNext: User account will be changed, please check your emails.",
            "EditQuitTitle: Delete user account",
            "EditQuitStatusNone: Please enter your name to confirm.",
            "EditQuitStatusMismatch: Please enter a different name.",
            "EditQuitStatusNext: User account will be deleted, please check your emails.",
            "EditConfigureTitle: Webbplats",
            "EditConfigureSitename: Name of the website:",
            "EditConfigureAuthor: Name of the webmaster:",
            "EditConfigureEmail: Email of the webmaster:",
            "EditConfigureInformation: The webmaster can approve new user accounts.",
            "EditConfigureStatusNone: Här kan du konfigurera din webbplats.",
            "EditConfigureStatusInvalid: Please enter a valid email.",
            "EditUpdateTitle: Uppdateringar",
            "EditUpdateStatusNone: Datenstrom Yellow är för människor som skapar små webbsidor.",
            "EditUpdateStatusCheck: Kollar efter uppdateringar…",
            "EditUpdateStatusUpdates: Följande uppdateringar är tillgängliga:",
            "EditUpdateStatusOk: Din webbplats är uppdaterad.",
            "EditOkButton: Ok",
            "EditCancelButton: Avbryt",
            "EditChangeButton: Ändra",
            "EditCreateButton: Skapa",
            "EditEditButton: Spara",
            "EditDeleteButton: Ta bort",
            "EditUpdateButton: Uppdatera",
            "EditEdit: Redigera sida",
            "EditCreate: +",
            "EditDelete: -",
            "EditKeyboardLabels: Ctrl+, Alt+, Shift+, ⌘, ⌥, ⇧",
            "EditToolbarFormat: Format",
            "EditToolbarHeading: Rubrik",
            "EditToolbarH1: Rubrik 1",
            "EditToolbarH2: Rubrik 2",
            "EditToolbarH3: Rubrik 3",
            "EditToolbarParagraph: Normal text",
            "EditToolbarPre: Källkod",
            "EditToolbarNotice: Indikation",
            "EditToolbarQuote: Citat",
            "EditToolbarBold: Fet",
            "EditToolbarItalic: Kursiv",
            "EditToolbarStrikethrough: Struken",
            "EditToolbarCode: Code",
            "EditToolbarList: Lista",
            "EditToolbarUl: • Osorterad lista",
            "EditToolbarOl: 1. Sorterad lista",
            "EditToolbarTl: ✓ Uppgiftslista",
            "EditToolbarLink: Länk",
            "EditToolbarFile: Fil",
            "EditToolbarEmoji: Emoji",
            "EditToolbarIcon: Ikon",
            "EditToolbarStatus: Status",
            "EditToolbarUndo: Ångra",
            "EditToolbarRedo: Gör om",
            "EditToolbarPreview: Förhandsvisning",
            "EditToolbarHelp: Hjälp",
            "EditMailFooter: @sitename",
            "EditDataGenerated: Den här sidan genereras automatiskt.",
            "EditUploadProgress: Laddar upp fil…",
            "EditUserDescription: Redaktör",
            "EditMenuSettings: Inställningar",
            "EditMenuHelp: Hjälp",
            "EditMenuLogout: Logga ut",
            "EditYellowUrl: https://datenstrom.se/sv/yellow/",
            "EditYellowHelpUrl: https://datenstrom.se/sv/yellow/help/",
            "EmojiDescription: Massor och massor av emoji.",
            "EnglishDescription: Engelska språket.",
            "FeedDescription: Feed med senaste ändringarna.",
            "FrenchDescription: Franska språket.",
            "GalleryDescription: Bildgalleri med popup.",
            "GermanDescription: Tyska språket.",
            "GooglecalendarDescription: Bädda in Google-kalender.",
            "GooglemapDescription: Bädda in Google-karta.",
            "HelloworldDescription: Skapa animerad text.",
            "HelpDescription: Hjälp för din webbplats.",
            "HighlightDescription: Markera källkod.",
            "HungarianDescription: Ungerska språket.",
            "IconDescription: Ikoner och symboler.",
            "ImageDescription: Bilder och miniatyrbilder.",
            "ImageDefaultAlt: Bild utan beskrivning",
            "InstagramDescription: Bädda in Instagram-foton.",
            "InstallTitle: Hej",
            "InstallLanguage: Vad är ditt språk?",
            "InstallExtension: Vad vill du göra?",
            "InstallExtensionWebsite: Liten webbsida",
            "InstallExtensionBlog: Liten blogg",
            "InstallExtensionWiki: Liten wiki",
            "InstallButton: Installera",
            "InstallHomeTitle: Hem",
            "InstallHomeText: [image photo.jpg Exempel rounded]\\n\\n[edit - Du kan redigera den här sidan i en webbläsare] eller använda en textredigerare. [Få hjälp](https://datenstrom.se/sv/yellow/help/).",
            "InstallAboutTitle: Om",
            "InstallAboutText: [Gjord med hjälp av Datenstrom Yellow](https://datenstrom.se/sv/yellow/).",
            "InstallDefaultTitle: Sida",
            "InstallDefaultText: Detta är en ny sida.",
            "InstallBlogTitle: Bloggsida",
            "InstallBlogText: Detta är en ny bloggsida.",
            "InstallWikiTitle: Wikisida",
            "InstallWikiText: Detta är en ny wikisida.",
            "InstallExampleImage: Detta är en exempelbild",
            "ItalianDescription: Italienska språket.",
            "JapaneseDescription: Japanska språket.",
            "MarkdownDescription: Textformatering för människor.",
            "MetaDescription: Metadata för människor och maskiner.",
            "NorwegianDescription: Norska språket.",
            "ParisDescription: Paris är ett elegant tema.",
            "ParsedownDescription: Textformatering för människor.",
            "PodcastDescription: Webbflöde optimerat för publicering av podcast.",
            "PolishDescription: Polska språket.",
            "PortugueseDescription: Portugisiska språket.",
            "PreviousnextDescription: Visa länkar till föregående/nästa sida.",
            "PreviousnextNavigation: Sidbyte",
            "PreviousnextPagePrevious: ← Tidigare: @title",
            "PreviousnextPageNext: Nästa: @title →",
            "PrivateDescription: Stöd för lösenordsskyddade sidor.",
            "PrivatePageError: Ange ditt lösenord.",
            "ProfileDescription: Författarprofil för bloggsidor.",
            "PublishDescription: Göra och publicera tillägg.",
            "RadiobossDescription: Widgets för RadioBoss Cloud.",
            "RandomDescription: Visa slumpmässiga sidor.",
            "ReadingtimeDescription: Visa den uppskattade lästiden för sidans innehåll.",
            "RedirectDescription: Alternativ sida omdirigering.",
            "RussianDescription: Ryska språket.",
            "SearchDescription: Heltekstsökning.",
            "SearchResultsNone: Skriv ett sökord.",
            "SearchResultsEmpty: Inga resultat funna.",
            "SearchSpecialChanges: Senaste ändringarna",
            "SearchButton: Sök",
            "ServeDescription: Inbyggd webbserver.",
            "SitemapDescription: Webbplatskarta med alla sidor.",
            "SliderDescription: Bildgalleri med reglaget.",
            "SlovakDescription: Slovakiska språket.",
            "SoundcloudDescription: Bädda in Soundcloud-ljudspår.",
            "SpanishDescription: Spanska språket.",
            "SpoilerDescription: Dölj vissa sidelement.",
            "StockholmDescription: Stockholm är ett rent tema.",
            "SwedishDescription: Svenska språket.",
            "TickerDescription: RSS-feed parser.",
            "TocDescription: Innehållsförteckning.",
            "TrafficDescription: Skapa trafikanalyser från loggfiler.",
            "TurkishDescription: Turkiska språket.",
            "TwitterDescription: Bädda in Twitter-meddelanden.",
            "UpdateDescription: Håll din webbplats uppdaterad.",
            "UpdateExtensionDefaultDescription: Ingen beskrivning finns tillgänglig.",
            "UpdateExtensionDeveloper: Utvecklad av @x.",
            "UpdateExtensionDesigner: Designad av @x.",
            "UpdateExtensionTranslator: Översatt av @x.",
            "WikiDescription: Wiki för din webbplats.",
            "WikiModified: Senast uppdaterad den",
            "WikiTag: Taggar:",
            "WikiSpecialPages: Alla sidor",
            "WikiSpecialChanges: Senaste ändringarna",
            "WittstockDescription: Wittstock är ett klasslöst tema.",
            "YoutubeDescription: Bädda in Youtube-videor."));
    }
    
    // Handle update
    public function onUpdate($action) {
        $fileName = $this->yellow->system->get("coreExtensionDirectory").$this->yellow->system->get("coreSystemFile");
        if ($action=="install") {
            $this->yellow->system->save($fileName, array("language" => "sv"));
        } elseif ($action=="uninstall" && $this->yellow->system->get("language")=="sv") {
            $this->yellow->system->save($fileName, array("language" => $this->yellow->system->getDifferent("language")));
        }
    }
}
