[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/magium/MagiumMagento/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/magium/MagiumMagento/?branch=master)

# Magium Magento

A PHPUnit/Webdriver (Selenium (there for SEO)) based test framework for streamlining browser testing with Magento.  It basically boils down to building out reusable Web Driver commands for Magento allowing you to bypass much of the boilerplate code that browser/functional testing may require.  This is done through utility classes.

[Find much more information at magiumlib.com](http://www.magiumlib.com/?utm_source=github&utm_medium=website&utm_campaign=social)

I had some good talks with some good folks this past week.  Now entering the 4th month of working on Magium I can honestly say that this past week was the most exciting week I've had.  It was a week when I allowed myself to think "maybe I am right about this after all!"  

But, truth be told, it's been a struggle to gain some traction.  People know, and I mean **really** know, that they should be automating this part of testing.  Every single person who I've talked about testing via the browser has said almost the exact same thing.  It's a great idea, but it takes too long and is too tedious.

Browser testing fails, in my humble opinion, because of problems that almost all software has.  It is a very common problem.  And it's so common I'm going to put it in `<H1>` tags to make sure everyone sees it.

# Software should have easy, early wins

In other words,with  software, especially new or unfamiliar software, you should have something useful to show with a minimal amount of effort.  That's why, I believe, despite there being several good packages out there for testing Magento with Selenium, including good ones by Magento, I believe that the reason very few use them is because they are not able to "ease" into them.

So what I am going to do is show you how you can get started with Magium, testing Magento using Selenium, in under 10 minutes.

These quick wins are on me :-)

## Step 1: Download and install Selenium Server and Chromedriver

Download [Selenium Server](http://www.seleniumhq.org/download/) and [Chrome WebDriver](https://sites.google.com/a/chromium.org/chromedriver/downloads)

Start it as so, replacing the jar file with whatever the current version is and the chromedriver.exe with whichever version you downloaded:

```
java -Dwebdriver.chrome.driver=chromedriver.exe -jar selenium-server-standalone-2.48.2.jar
```

## Step 2: Download and install Magento CE 1.9 with the Sample Data

*Note: this doesn't count against the 10 minutes*

Make sure that it is working first before you start the timer. (I presume you don't need instructions on how to do this)

**But shouldn't I start with my own code?**

No.  Start with what is common, then move to what is unique.  It will be a lot easier.

## Step 3: Clone the sample test cases

```
git clone https://github.com/magium/MagiumMagentoExample.git
```

## Step 4 - Edit 4 files

Edit the following files:

* configuration/Magium/Magento/Identities/Admin.php - **Enter your admin credentials**
* configuration/Magium/Magento/Identities/Customer.php - **Enter some default user credentials**
* configuration/Magium/Magento/Themes/Admin/ThemeConfiguration.php - **Change the baseUrl setting**
* configuration/Magium/Magento/Themes/Magento19/ThemeConfiguration.php - **Change the baseUrl setting**

## Step 5 - Run composer

```
composer install
```

or if you have a custom phar installed

```
php composer.phar install
```

## Step 6 - Run PHPUnit

If you are using PHPStorm all you need to do is right click on phpunit.xml.dist and select 'Run phpunit.xml.dist'

If you are running PHPUnit from the command line you will need to exectue

```
phpunit -c tests/phpunit.xml.dist
```

And with that you should see 15 tests running and passed after a few minutes.

[http://magiumlib.com/blog/wp-content/uploads/2016/03/2016-03-04_1204.png"]

Does it really work this easily?  Check out the video below to see Magium in action.

[![Building a test in Magium](https://img.youtube.com/vi/-GhWAOuj8GM/0.jpg)](https://www.youtube.com/watch?v=-GhWAOuj8GM)

