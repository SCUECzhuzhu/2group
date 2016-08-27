#!/usr/bin/python


verbose = True
if verbose:
    pass
    #print "Loading python libraries ....."
else:
    print "verbose output has been disabled verbose=False"
import threading
import picamera
import picamera.array
import datetime
import time
import urllib
import urllib2
#from bs4 import BeautifulSoup
from PIL import Image
from PIL import ImageFont
from PIL import ImageDraw
from fractions import Fraction

#Constants
SECONDS2MICRO = 1000000  # Constant for converting Shutter Speed in Seconds to Microseconds

# User Customizable Settings
imageDir = "images"
imagePath = "/home/pi/pimotion/" + imageDir
imageNamePrefix = 'capture-'  # Prefix for all image file names. Eg front-
imageWidth = 1024
imageHeight = 576
imageVFlip = False   # Flip image Vertically
imageHFlip = False   # Flip image Horizontally
imagePreview = False

numberSequence = False

threshold = 10  # How Much pixel changes
sensitivity = 100  # How many pixels change

nightISO = 800
nightShutSpeed = 6 * SECONDS2MICRO  # seconds times conversion to microseconds constant

# Advanced Settings not normally changed 
testWidth = 100
testHeight = 75

f=open('/home/pi/pimotion/information.txt','r')
content=f.readline()
information=eval(content)
name=information['name']
f.close()

def checkImagePath(imagedir):
    # Find the path of this python script and set some global variables
    mypath=os.path.abspath(__file__)
    baseDir=mypath[0:mypath.rfind("/")+1]
    baseFileName=mypath[mypath.rfind("/")+1:mypath.rfind(".")]

    # Setup imagePath and create folder if it Does Not Exist.
    imagePath = baseDir + imagedir  # Where to save the images
    # if imagePath does not exist create the folder
    if not os.path.isdir(imagePath):
        if verbose:
            print "%s - Image Storage folder not found." % (progName)
            print "%s - Creating image storage folder %s " % (progName, imagePath)
        os.makedirs(imagePath)
    return imagePath


def takeMotionImage(width, height, daymode): #抓取摄像头图片
    with picamera.PiCamera() as camera:        
        camera.resolution = (width, height)
        with picamera.array.PiRGBArray(camera) as stream:
            if daymode:
                camera.exposure_mode = 'auto'
                camera.awb_mode = 'auto' 
            else:
                # Take Low Light image            
                # Set a framerate of 1/6 fps, then set shutter
                # speed to 6s and ISO to 800
                camera.framerate = Fraction(1, 6)
                camera.shutter_speed = nightShutSpeed
                camera.exposure_mode = 'off'
                camera.iso = nightISO
                # Give the camera a good long time to measure AWB
                # (you may wish to use fixed AWB instead)                
            camera.capture(stream, format='rgb')
            return stream.array

def scanIfDay(width, height, daymode):
    data1 = takeMotionImage(width, height, daymode)
    while not motionFound:
        data2 = takeMotionImage(width, height, daymode)
        pCnt = 0L;
        diffCount = 0L;
        for w in range(0, width):
            for h in range(0, height):
                # get the diff of the pixel. Conversion to int
                # is required to avoid unsigned short overflow.
                

#得到像素的差异。转换为int

#需要避免无符号短整数溢出。 
                diff = abs(int(data1[h][w][1]) - int(data2[h][w][1]))
                if  diff > threshold:
                    diffCount += 1
            if diffCount > sensitivity:
                break; #break outer loop.
        if diffCount > sensitivity:
            motionFound = True
        else:
            # print "Sum of all pixels=", pxCnt
            data2 = data1              
    return motionFound
           
def scanMotion(width, height, daymode):#扫描判断是否移动
    motionFound = False
    data1 = takeMotionImage(width, height, daymode)
    while not motionFound:
        data2 = takeMotionImage(width, height, daymode)
        diffCount = 0L;
        for w in range(0, width):
            for h in range(0, height):
                # get the diff of the pixel. Conversion to int
                # is required to avoid unsigned short overflow.
                diff = abs(int(data1[h][w][1]) - int(data2[h][w][1]))
                if  diff > threshold:
                    diffCount += 1
            if diffCount > sensitivity:
                break; #break outer loop.
        if diffCount > sensitivity:
            motionFound = True
        else:
            data2 = data1              
    return motionFound

  
def add(i):
    i=i+1
    return i    

def motionDetection():
    global number
    #print "Scanning for Motion threshold=%i sensitivity=%i ......"  % (threshold, sensitivity)
    isDay = True
    currentCount= 1000
    while True:
        if scanMotion(testWidth, testHeight, isDay):
            
            if numberSequence:
                currentCount += 1
            if isDay:                
                number=add(number)
                #print number
                
            else:              
                
                print 'errer'
                

def runsleep():
    interval=60
    url='http://1.raspberrypiphp.applinzi.com/insert.php' 
    user_agent='Mozilla/4.0(compatible;MSIE 5.5;Windows NT)'
    headers={'User-Agent' : user_agent}
    while True:
        try:
            time_remaining=interval-time.time()%interval
            time.sleep(time_remaining)
            #print 'kai shi shang chuan'
            frequency=transmit(number)
            values={'name':'%s'%name,'frequency':'%s'%frequency}
            data=urllib.urlencode(values)
            request=urllib2.Request(url,data)
            response=urllib2.urlopen(request,timeout=3)
            the_page=response.read()
            #soup=BeautifulSoup(the_page,'lxml')
            #print soup.p.text
            #print the_page
            #print'-------'
        except Exception, e:
            print e

def transmit(number):
    return number
        
number=1

threads=[]
t1=threading.Thread(target=motionDetection)
threads.append(t1)
t2=threading.Thread(target=runsleep)
threads.append(t2)
             
if __name__ == '__main__':
    
    try:
        for t in threads:
            t.setDaemon(True)
            t.start()

        t.join()

    finally:
        print 'end'


