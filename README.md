
LTI Proxy
=========

This is a component of the [Tsugi PHP Project](https://github.com/csev/tsugi).

Running The Application
-----------------------

Once you have connected this tool to a Tsugi install as described above, 
you can use the Admin/Database Upgrade feature to create / maintain database 
tables for this tool.  You can also use the Developer mode of that Tsugi to
test launch this tool.   The LTI 2.0 support, CASA Support, and Content Item
support for the controlling Tsugi will know about this tool.

LTI 1.x launches simply are directed to the index.php in this folder:

    http://localhost:8888/py4e/mod/simple-lti/
    key: 12345
    secret: secret

Keys and secrets are managed through the controlling Tsugi.
