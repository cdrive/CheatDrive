OC.L10N.register(
    "files_antivirus",
    {
    "Clean" : "Vyčistit",
    "Infected" : "Nakažené",
    "Unchecked" : "Nezaškrtnuto",
    "Scanner exit status" : "Návratový stav skeneru",
    "Scanner output" : "Výstup ze skeneru",
    "Saving..." : "Ukládání…",
    "Antivirus" : "Antivirus",
    "File {file} is infected with {virus}" : "Soubor {file} je infikován {virus}",
    "The file has been removed" : "Soubor byl odebrán",
    "File containing {virus} detected" : "Zjištěn soubor obsahující {virus}",
    "Antivirus detected a virus" : "Antivirus zjistil virus",
    "Virus %s is detected in the file. Upload cannot be completed." : "V souboru byl zjištěn virus %s. Nahrávání nebylo možné dokončit.",
    "Saved" : "Uloženo",
    "Antivirus for files" : "Antivir pro soubory",
    "An antivirus app for Nextcloud based on ClamAV" : "Aplikace antiviru pro Nextcloud založená na ClamAV",
    "Antivirus for files is an antivirus app for Nextcloud based on ClamAV.\n\n* 🕵️‍♂️ When the user uploads a file, it's checked\n* ☢️ Uploaded and infected files will be deleted and a notification will be shown and/or sent via email\n* 🔎 Background Job to scan all files\n\nThis application inspects files that are uploaded to Nextcloud for viruses before they are written to the Nextcloud storage. If a file is identified as a virus, it is either logged or not uploaded to the server. The application relies on the underlying ClamAV virus scanning engine, which the admin points Nextcloud to when configuring the application.\nFor this app to be effective, the ClamAV virus definitions should be kept up to date. Also note that enabling this app will impact system performance as additional processing is required for every upload. More information is available in the Antivirus documentation." : "Antivirus pro Soubory je antivirová aplikace pro Nextcloud, založená na ClamAV.\n\n* 🕵️‍♂️ Když uživatel nahraje soubor, je zkontrolován\n* ☢️ Nahrané, ale infikované soubory budou smazány a bude zobrazeno upozornění a/nebo posláno e-mailem\n* 🔎 Skenování všech souborů na pozadí\n\nTato aplikace provede inspekci souborů, které jsou nahrané na Nextcloud server ohledně virů, než jsou zapsány na úložiště. Když je soubor identifikován jako virus, je to buďto zaznamenáno nebo vůbec nenahráno na server. Aplikace závisí na skenovacím engine ClamAV, na který správce nasměruje Nextcloud při nastavování této aplikace.\nAby tato aplikace byla účinná, je třeba udržovat aktuální virové definice pro ClamAV. Také poznamenejme, že zapnutí této aplikace bude mít dopad na výkon systému a při každém nahrání je zapotřebí další zpracování. Více informací je k dispozici v dokumentaci k Antivirus.",
    "Greetings {user}," : "Zdravíme {user},",
    "Sorry, but a malware was detected in a file you tried to upload and it had to be deleted." : "Je nám líto, ale v souboru, který jste nahráli byl nalezen škodlivý software a bylo nutno soubor smazat.",
    "This email is a notification from {host}. Please, do not reply." : "Tento e-mail je upozornění z {host}. Neodpovídejte na něj.",
    "File uploaded: {file}" : "Nahrán soubor: {file}",
    "Antivirus for Files" : "Antivir pro soubory",
    "Mode" : "Režim",
    "Executable" : "Spustitelný soubor",
    "Daemon" : "Proces služby",
    "Daemon (Socket)" : "Démon (soket)",
    "Socket" : "Soket",
    "Clamav Socket." : "Soket ClamAV.",
    "Not required in Executable Mode." : "Ve spustitelném režimu není třeba.",
    "Host" : "Stroj",
    "Address of Antivirus Host." : "Adresa stroje s antivirem.",
    "Port" : "Port",
    "Port number of Antivirus Host." : "Číslo portu hostitele antiviru.",
    "Stream Length" : "Délka proudu",
    "ClamAV StreamMaxLength value in bytes." : "Hodnota ClamAV StreamMaxLength (v bajtech).",
    "bytes" : "bajtů",
    "Path to clamscan" : "Cesta k clamscan",
    "Path to clamscan executable." : "Popis umístění spustitelného souboru clamscan",
    "Not required in Daemon Mode." : "Není vyžadováno v režimu procesu služby.",
    "Extra command line options (comma-separated)" : "Dodatečné volby příkazové řádky (oddělené čárkou)",
    "File size limit, -1 means no limit" : "Limit velikosti souboru, -1 znamená bez omezení",
    "Background scan file size limit in bytes, -1 means no limit" : "Do jaké jejich velikosti skenovat soubory na pozadí (v bajtech), -1 znamená bez omezení",
    "When infected files are found during a background scan" : "Pokud jsou při skenování na pozadí nalezeny nakažené soubory",
    "Only log" : "Pouze zaznamenávat",
    "Delete file" : "Smazat soubor",
    "Save" : "Uložit",
    "Advanced" : "Pokročilé",
    "Rules" : "Pravidla",
    "Clear All" : "Vyčistit vše",
    "Reset to defaults" : "Vrátit na výchozí",
    "Match by" : "Hledat shodu s",
    "Scanner exit status or signature to search" : "Návratový stav skeneru nebo signatura kterou hledat",
    "Description" : "Popis",
    "Mark as" : "Označit jako",
    "Add a rule" : "Přidat pravidlo"
},
"nplurals=4; plural=(n == 1 && n % 1 == 0) ? 0 : (n >= 2 && n <= 4 && n % 1 == 0) ? 1: (n % 1 != 0 ) ? 2 : 3;");