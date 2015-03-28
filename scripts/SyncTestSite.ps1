while ($true)
{
	Start-Sleep -Seconds 5
	
	CMD /C '""C:\Program Files\TortoiseSVN\bin\TortoiseProc.exe" /command:update /path:"E:\sandboxes\bottletrade-autosync" /closeonend:1"'
}
