CodeJudge

### Introduction
Codejudge is cool system to host coding competitions, something very similar to ICPC or like the Codechef website. Only better, because you can hack on Codejudge to customise it and run it from anywhere, even from your system!

Codejudge can be run from any PHP, MySQL server and can be used to power any coding competition and evaluate its solutions automatically.

Now its no need to run to big companies to host your event. You can set up Codejudge almost anywhere and anytime!


### Getting Codejudge
You can get the latest source of Codejudge from the repository [here](https://github.com/jerinisready/codejudge). You might just want to download the [ZIP archive](https://github.com/jerinisready/codejudge/zipball/master).


Codejudge is hell easy to setup. 

Installation Of Environment
```````````````````````````

UPDATE PACKAGES     : `sudo apt-get update`

APACHE WEB SERVER   : `sudo apt-get install apache2`

MYSQL SERVER        : `sudo apt-get install mysql-server mysql-client`

PHP                 : `sudo apt-get install php5 libapache2-mod-php5`

PHPMYADMIN          : `sudo apt-get install phpmyadmin`

RESTART SERVER      : `sudo /etc/init.d/apache2 restart`

CHECK PHP           : `php -r 'echo "\n\nYour PHP installation is working fine.\n\n\n";'`

GCC (c compiler)    : `sudo apt-get install gcc`

G++ (c++ compiler)  : `sudo apt-get install g++`

Java Compiler       : `sudo add-apt-repository ppa:webupd8team/java`
Java Compiler       : `sudo apt update;`
Java Compiler       : `sudo apt install oracle-java8-installer`
Java Compiler       : `sudo apt install oracle-java8-set-default`

Python Compiler     : `sudo apt-get install python`

FOLDER PERMISSION   : `sudo chmod 0777 /var/www/html`

Move your folder `CodeJudge` to  `/var/www/html`

CREATE A DATABASE   @ `localhost/phpmyadmin/index.php`

GO TO               @ `localhost/CodeJudge/`

DATABASE NAME : > name of created database <
DATABASE USER :  `root`                 (for beginers)
DATABASE PASS :   `rootpassword`        (password set during MYSQL installation)
DATABASE HOST :  `localhost` 

COMPILER SERVER : `localhost`
COMPILER PORT   : `3029`                //LET IT BE


### In case you are interested
Codejudge is still in its infant stages of development. If you find any bugs or security loopholes in Codejudge please do report them [here](https://github.com/jerinisready/codejudge/issues). Or better still, fork Codejudge on [Github](https://github.com/sankha93/codejudge) and start hacking on it. I'll be waiting for your pull request.

### Author
Codejudge is made with all the love by @sankha93 [@sankha93](https://twitter.com/sankha93) on Twitter. And jerinisready [@jerinisready](https://www.facebook.com/jerinisready) [@gmail](mailto:jerinisready[at]gmail[dot]com)

### Support or Contact
If you have a bug report or feature request then post it on the [Codejudge issues](https://github.com/jerinisreaedy/codejudge/issues) or mail me at jerinisready[at]gmail[dot]com and I will get back to you.




====================================================================================================================


CodeJudge
=========
Coding competitions are now easy to organise anytime, anywhere. Judge the code on right time, Have Live ScoreBoard too...

Codejudge can be run from any PHP, MySQL server and can be used to power any coding competition and evaluate its solutions automatically.

Hope you had installed an apache2 server / mysql database in your system.

For zero beginners:

            * This CodeJudge can be hosted only at a Linux platform.(Preferrably Ubuntu).
            * install lamp (apache2, mysql, php5, phpmyadmin(optional))
            * other requirements (gcc, g++, javac, java python)
            * an IDE; preferrably ECLIPSE.

=============================================================================================

FEATURES
````````

*   SIMPLE

*   LIGHT WEIGHT

*   SUPPORTS C, CPP, JAVA, PYTHON.

*   ONLINE PROGRAM VALIDATION

*   LIVE SCOREBOARD

*   PROGRAM EXECUITION TIME CONTROL

*   POINTS FOR EACH QUESTION

*   



=============================================================================================   


ARCHITECTURE
````````````

Here we are using two servers. 

* WEB END APACHE SERVER.

    Web End Apache Server will be working on port 80 as normal.

* JAVA END COMPILATION / JUDGING SERVER

    Here open an IDE (ie Eclipse). Create an Existing Project. (locating at /var/www/html/Codejudge/codejudge-compiler/)

    Run The project. Java server will start working and waits for data packets.
