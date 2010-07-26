Akismet

About
-----
Akismet is a spam detection service that can eliminate comment and trackback spam from your site.

Installation
------------
Installation of the module follows the same procedure as other Zikula modules. Copy the akismet directory
to your modules directory (modules/). From the modules admin panel regenerate the modules list then initialize
and activate the akismet module.

Usage
-----
On its own the akismet module doesn't do anything! The module is the gateway to the akismet service for other
modules to take advantage of. The first module to do so is EZComments. When an akismet enabled version of
EZComments (v1.5+) is installed all new comments can be passed to akismet for checking.

In order for your site to utilize the akismet service you require an API key - this identifies your personal
communications through the akismet service. See http://wordpress.com/api-keys/ for more details.

Developers
----------
To take advantage of the akismet module in your own modules the module exposes a number of APIs. See the 
API documentation (modules/akismet/pndocs/api.pdf) for more information.