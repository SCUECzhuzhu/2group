
将文件解压到pi文件夹下

#安装摄像头库
sudo apt-get install python-imaging
sudo apt-get install python-picamera


#安装网页解析库
sudo apt-get install Python-bs4
sudo apt-get install Python-lxml

information.txt 用来存储用户名


python ./scan.py

自启动：
修改 /etc/rc.local 文件 加入
python /home/pi/pimotion/python_scan.py &

