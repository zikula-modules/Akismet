Akismet

About
-----
Akismet is a spam detection service that can eliminate comment and trackback spam from your site.

Installation
------------
Installation of the module follows the same procedure as other Zikula modules. Copy the akismet directory
to your modules directory (modules/). From the extensions admin panel initialize the Akismet module.

Usage
-----
On its own the Akismet module doesn't do anything! The module is the gateway to the Akismet service for other
modules to take advantage of. The first module to do so is EZComments. When an Akismet enabled version of
EZComments (v1.5+) is installed all new comments can be passed to Akismet for checking.

In order for your site to utilize the akismet service you require an API key - this identifies your personal
communications through the Akismet service. See http://wordpress.com/api-keys/ for more details.

Developers
----------
To take advantage of the Akismet module in your own modules the module exposes a number of APIs. See the 
EZComments  module for more information.