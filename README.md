# Logcamp

Logcamp was developed within DevOps as a potential measure to assist developers in acquiring various logs that are commonly requested. 

The aim of this module is to cut out the middle man (DevOps) in supplying these logs and thus reducing the overall turnaround time for developers to find the errors they are seeking and to ultimatley resolve those errors in a speedy fashion.

DevOps also benefits by being less prone to the disruptive nature of these kinds of requests.

## Benefits over competing modules:

While Logcamp is strictly as simple a module as can be, the following forms part of its one key benefit.

As it is often the case that FE and BE servers are seperated, existing community modules tend to not cater for this and assume that FE and BE exist on the same server, thus would only produce the log directories on the BE server and not of the FE server as the logs are accessed from within the Admin itself. Some examples of these modules are as follows:

* https://www.magentocommerce.com/magento-connect/log-viewer-1.html
* https://www.mgt-commerce.com/magento-graylog-log-management.html


What Logcamp allows for is the simple access to the below mentioned log directories without the need to use the Admin pages and is accessed simply by means of a URI on the respective domain and grants access to the log directories of the respective servers domain it's associated with, for example:


![alt text](http://d2ioaku7np9ucf.cloudfront.net/logcamp.png "Diagram")





## Module Requirements:


* Magento 1 Enterprise
* Must be included in a projects composer.json file like so:

`"redbox/logcamp": "<Branch or Tag>"`

`{
      "type": "vcs",
      "url": "git@github.com:Fabio101/logcamp.git"
    }`
    
* HTTPS on the vhost must be enabled as the module will force the user to HTTPS to protect the login form and data downloaded by the client.
* For Nginx, read permissions are required on /var/log/nginx:

`find /var/log/nginx/ -type f -exec chmod 0644 {} \;`

`find /var/log/nginx/ -type d -exec chmod 0655 {} \;`

* Lastly, it is recommended to further lock down the URI via HTTP Authentication for additional security and the prevention of indexing of the URI.

## Allowed Directories:

Only the following directories are exposed to the end user:

* (Magento DocRoot)/var/log
* (Magento DocRoot)/var/report
* /var/log/nginx

Any attempted access to paths that fall outside of this list are forbidden and will not work.

## User Access:

Access to the module is done via URI and requires the '/logcamp' path to be supplied as the base path:

`http://<YOUR DOMAIN>/logcamp`

Access is granted to Logcamp to any user who has an Admin Username and Password.

It is suggested for the sake of security, if adding a new Admin user to a particular instance of Magento, to create a very limited Admin role, and assign that user that role. This way, if you want to grant only access to logcamp you can strictly limit what that user is able to see and do on the Admin page itself.
