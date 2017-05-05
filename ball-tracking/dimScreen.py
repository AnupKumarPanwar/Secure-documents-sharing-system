import win32gui
import win32con
 
def windowEnumerationHandler(hwnd, top_windows):
    top_windows.append((hwnd, win32gui.GetWindowText(hwnd)))
 
results = []
top_windows = []
win32gui.EnumWindows(windowEnumerationHandler, top_windows)
print top_windows
for i in top_windows:
    if "notepad" in i[1].lower():
        print i
        # win32gui.ShowWindow(i[0],5)
        # win32gui.ShowWindow(i[0], win32con.SW_MAXIMIZE)
        # win32gui.SetForegroundWindow(i[0])

        # win32gui.ShowWindow(i[0], win32con.SW_MINIMIZE)
        break

# style = win32con.WS_OVERLAPPED | win32con.WS_SYSMENU
# hwnd = win32gui.CreateWindow(class_atom,
#                              window_class_name,
#                              style,
#                              0,
#                              0,
#                              310,
#                              250,
#                              0,
#                              0,
#                              hinst,
#                              None)
# win32gui.UpdateWindow(hwnd)