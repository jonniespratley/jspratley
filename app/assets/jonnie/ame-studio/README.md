# ame-studio
The ame-studio module is a set of sub-modules that enabled the functionality to allow a user to create a new application, manage an existing application, and manage the content and resources of their applications using the MyAppMatrix CMS.


https://myappmatrix.local/app/webroot/js/modules/builder/builder/




### Directory Structure
The application is broken down into seperate folders and files, here is the directory stucture.



	ame-studio/
		index.html
		controllers.js
		components.js
		readme.md
		builder/
			index.html
			components.js
			controllers.js
			builderComponent.html
			debugComponent.html
			detailComponent.html
			infoComponent.html
			listComponent.html
			mainComponent.html
			modalComponents.html
			sidebarComponent.html
			toolbarComponent.html
			wizardComponent.html
		views/
			builder.html
			device.html
			homescreen.html
			index.html
			smartapp.html
			studio.html
			wizard.html		




## SmartApp Wizard
Here is a summary of the SmartApp builder, including the different packages and there modules, also the process that a user must take to create a SmartApp.



## Technologies
The technologies used to make the SmartApp Wizard are as follows:

* Twitter Bootstrap
* Angular.js 




### Client Side 
The UI is valid HTML5 and CSS3 and with Twitter Bootstrap for the UI components.

### Server Side 
The server side component of the wizard is written in PHP, leveraging the framework of CakePHP for handling many server side processes such as File reading/writing, connecting to MySQL database and other server side actions.


### Output
The wizard outputs many files and folders, the packages are:


 * Titanium Mobile project archive
 * jQuery Mobile project archive






---



## 1. Login or Create Account
Users must register or login to use the SmartApp Builder.


## 2. Packages


### Package 1 - Native App



### Package 2 - Hybrid App
Manage Geo based content, this delivers Geo based content to users of your app. Also allows you to monitor Geo Analytics, getting information about when and where users are using your app.

### Package 3 - Smart App
This is a mix between a Native app and a Hybrid app, using our predefined templates and views lets you create a "Smart" application using mobile design patterns.

### Package 4 - Custom App
This is a fully customizable application that can have various modules and other assets.


#### Core Modules
This is list of the core modules that every SmartApp will have.

* **[[Push Notifications]]** - Users can send Push Notifications to there app
* **[Analytics]** - General app analytics.
* **[[Cloud Storage]]** - All app assets and data will be stored in the cloud.
* **[[Social Media]]** - Users can monitor basic social media networks.
* **[[Calendar]]** - Marking app updates, etc.
* **[[Devices]]** - Shows all devices in which the app is installed.
* **[[SmartApp Builder]]** - This is where users can modify there existing app.
* **[[Support Tickets]]** - This is where users can submit support request tickets.




## 3. Assets
Users must upload 4 images, these images will be used for the following.

* **57x57** - This is your app icon used on all devices.
* **72x72** - This is your app iPad icon, used on iPad devices.
* **119x119** - This is your Hi-Res icon used on iPhone 4+ devices.
* **512x512** - This is your AppStore/Android Marketplace icon on profile page.











## 4. Customizable
This is where users can customize there application. Customizing the app includes the following:
Users can add as many screens to there app within the module boundaries. Each screen will have the option of the following:





### I. Headers
There are 3 headers to choose from:

* **Basic** - This is a basic header which displays the current screen title and/or back button.
* **Action** - This is a action header which displays the current screen title, action button and cancel button.
* **Nav** - This is a navigation header which allows the user to navigate the current screen to child screens.



### II. Content
There are 3 different content types to choose from including:

#### 1. Lists - There are many list types to choose from:

* **Basic** - A basic list with options for title and detail page.
* **Icon** - A icon list with options for title, detail page and bubble count.
* **Thumbnail** - A thumbnail list with options for image, title, description and detail page.
* **Split** - A split list with options for divider, title, detail page, bubble count and action button. ( Add to cart, buy now, etc).
* **Nested** - A nested list will display parent items with hidden child items, with options for title, children and detail page.


#### 2. Forms
There are many form elements to choose from including:

* **Inputs** - This supports any type of HTML5 input types



### III. Footers 
There are 3 footer types to choose from including:

* **Basic** - This is a basic footer displaying the app name.
* **Action** - This is a action footer with action buttons for the current screen.
* **Nav** - This is a nav footer with nav buttons to navigate the current screens child screens.
	


## 5. Preview
The preview portion of the SmartApp builder will allow a user to preview there application (web app) version. 
This version will be create with jQuery Mobile and using jQuery Templates. 
This app will be 100% generated on the fly with the use a custom jQuery Mobile PHP library. 
This library has been extended to include the most recent build of jQuery Mobile. 





## 6. Deploy
