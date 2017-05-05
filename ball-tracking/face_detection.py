# from win32api import Beep
import win32gui
import win32con
import numpy as np
import cv2
import time
import urllib2
import win32clipboard
import shutil
from subprocess import call



def windowEnumerationHandler(hwnd, top_windows):
    top_windows.append((hwnd, win32gui.GetWindowText(hwnd)))


# multiple cascades: https://github.com/Itseez/opencv/tree/master/data/haarcascades

#https://github.com/Itseez/opencv/blob/master/data/haarcascades/haarcascade_frontalface_default.xml
face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
#https://github.com/Itseez/opencv/blob/master/data/haarcascades/haarcascade_eye.xml
eye_cascade = cv2.CascadeClassifier('haarcascade_eye.xml')

cap = cv2.VideoCapture(0)

noOfFaces=[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,];

count=0;
called=0;
captureCount=0;

while 1:


    try:
        shutil.rmtree('C:\Users\Anup\Pictures\Screenshots', ignore_errors=False, onerror=None)
    except Exception as e:
        pass


    ret, img = cap.read()
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_cascade.detectMultiScale(gray, 1.3, 5)

    # if len(faces)==0:
    # 	cap.release()
    # 	cv2.destroyAllWindows()
    results = []
    top_windows = []
    win32gui.EnumWindows(windowEnumerationHandler, top_windows)

    noOfFaces.append(len(faces))

    # print noOfFaces[:-15:-1]
    noOfFaces2=noOfFaces[:-5:-1]
    print noOfFaces2
    if 1 in noOfFaces2:
    	# Beep(3000, 500)
    	for i in top_windows:
    	    if "crypten" in i[1].lower():
                count=count-1
    	        print i

    	        captureCount=captureCount+1

    	        if captureCount==5:
    	        	cv2.imwrite('C:\wamp64\www\chatburn\Crypten\public\culprits\culprit.png', img)

                win32clipboard.OpenClipboard(i[0])
                win32clipboard.EmptyClipboard()

    	        win32gui.ShowWindow(i[0],5)
    	        win32gui.ShowWindow(i[0], win32con.SW_MAXIMIZE)
    	        try:
    	        	win32gui.SetForegroundWindow(i[0])
    	        except Exception as e:
    	        	pass
    	        
    	        break

    if 1 not in noOfFaces2 :
    	for i in top_windows:
    	    if "crypten" in i[1].lower():
                count=count+1
    	        print i

                win32clipboard.OpenClipboard(i[0])
                win32clipboard.EmptyClipboard()
    	        win32gui.ShowWindow(i[0], win32con.SW_MINIMIZE)
    	        break

    print count
    if count<0:
        count=0
    


    if count==20 and called==0:
        called=1
        try:
        	call(["explorer","http://iluvmahima.herokuapp.com/8968894728/Mister Anoop, Someone is trying to copy your files. Please review your logs."])
	        print urllib2.urlopen("http://iluvmahima.herokuapp.com/8968894728/Mister Anoop, Someone is trying to copy your files. Please review your logs.").read()
        except Exception as e:
            pass
        
        


    for (x,y,w,h) in faces:
        cv2.rectangle(img,(x,y),(x+w,y+h),(255,0,0),2)
        roi_gray = gray[y:y+h, x:x+w]
        roi_color = img[y:y+h, x:x+w]
        
        eyes = eye_cascade.detectMultiScale(roi_gray)
        for (ex,ey,ew,eh) in eyes:
            cv2.rectangle(roi_color,(ex,ey),(ex+ew,ey+eh),(0,255,0),2)

    # cv2.imshow('img',img)
    k = cv2.waitKey(30) & 0xff
    if k == 27:
        break

cap.release()
cv2.destroyAllWindows()