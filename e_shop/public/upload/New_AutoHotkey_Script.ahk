$F10:: ;Run the bot
WinGet, programid, List, FINAL FANTASY
Loop
	{
	Loop 70
		{
		ControlSend,,{Numpad0}, ahk_id %programid1% 
		Sleep 500
		ControlSend,,{Numpad0}, ahk_id %programid1% 
		Sleep 3000
		ControlSend,,{2}, ahk_id %programid1% 
		Sleep 24000
		ControlSend,,{3}, ahk_id %programid1% 
		Sleep 16500
		}
	ControlSend,,{Escape}, ahk_id %programid1% 
	Sleep 3000
	ControlSend,,{Numpad0}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Numpad0}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Numpad6}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Numpad0}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Numpad4}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Numpad0}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{Escape}, ahk_id %programid1% 
	Sleep 2000
	ControlSend,,{N}, ahk_id %programid1%
	Sleep 1000
	ControlSend,,{Numpad0}, ahk_id %programid1% 
	}
Return
$F11:: ;Exit
Msgbox, Shutting Down.
ExitApp