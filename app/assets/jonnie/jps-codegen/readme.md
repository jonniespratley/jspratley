# Mou

![Mou icon](http://mouapp.com/Mou_128.png)

## Overview

**Mou**, the missing Markdown editor for *web developers*.

### Syntax

#### Strong and Emphasize 

**strong** or __strong__ ( Cmd + B )

*emphasize* or _emphasize_ ( Cmd + I )

**Sometimes I want a lot of text to be bold.
Like, seriously, a _LOT_ of text**

#### Blockquotes

> Right angle brackets &gt; are used for block quotes.

#### Links and Email

An email <example@example.com> link.

Simple inline link <http://chenluois.com>, another inline link [Smaller](http://smallerapp.com), one more inline link with title [Resize](http://resizesafari.com "a Safari extension").

A [reference style][id] link. Input id, then anywhere in the doc, define the link with corresponding id:

[id]: http://mouapp.com "Markdown editor on Mac OS X"

Titles ( or called tool tips ) in the links are optional.

#### Images

An inline image ![Smaller icon](http://smallerapp.com/favicon.ico "Title here"), title is optional.

A ![Resize icon][2] reference style image.

[2]: http://resizesafari.com/favicon.ico "Title"

#### Inline code and Block code

Inline code are surround by `backtick` key. To create a block code:

	Indent each line by at least 1 tab, or 4 spaces.
    var Mou = exactlyTheAppIwant; 

####  Ordered Lists

Ordered lists are created using "1." + Space:

1. Ordered list item
2. Ordered list item
3. Ordered list item

#### Unordered Lists

Unordered list are created using "*" + Space:

* Unordered list item
* Unordered list item
* Unordered list item 

Or using "-" + Space:

- Unordered list item
- Unordered list item
- Unordered list item

#### Hard Linebreak

End a line with two or more spaces will create a hard linebreak, called `<br />` in HTML. ( Control + Return )  
Above line ended with 2 spaces.

#### Horizontal Rules

Three or more asterisks or dashes:

***

---

- - - -

#### Headers

Setext-style:

This is H1
==========

This is H2
----------

atx-style:

# This is H1
## This is H2
### This is H3
#### This is H4
##### This is H5
###### This is H6


### Extra Syntax

#### Footnotes

Footnotes work mostly like reference-style links. A footnote is made of two things: a marker in the text that will become a superscript number; a footnote definition that will be placed in a list of footnotes at the end of the document. A footnote looks like this:

That's some text with a footnote.[^1]

[^1]: And that's the footnote.


#### Strikethrough

Wrap with 2 tilde characters:

~~Strikethrough~~


#### Fenced Code Blocks

Start with a line containing 3 or more backticks, and ends with the first line with the same number of backticks:

```
Fenced code blocks are like Stardard Markdown’s regular code
blocks, except that they’re not indented and instead rely on
a start and end fence lines to delimit the code block.
```

#### Tables

A simple table looks like this:

First Header | Second Header | Third Header
------------ | ------------- | ------------
Content Cell | Content Cell  | Content Cell
Content Cell | Content Cell  | Content Cell

If you wish, you can add a leading and tailing pipe to each line of the table:

| First Header | Second Header | Third Header |
| ------------ | ------------- | ------------ |
| Content Cell | Content Cell  | Content Cell |
| Content Cell | Content Cell  | Content Cell |

Specify alignement for each column by adding colons to separator lines:

First Header | Second Header | Third Header
:----------- | :-----------: | -----------:
Left         | Center        | Right
Left         | Center        | Right


### Shortcuts

#### View

* Toggle live preview: Shift + Cmd + I
* Toggle Words Counter: Shift + Cmd + W
* Toggle Transparent: Shift + Cmd + T
* Toggle Floating: Shift + Cmd + F
* Left/Right = 1/1: Cmd + 0
* Left/Right = 3/1: Cmd + +
* Left/Right = 1/3: Cmd + -
* Toggle Writing orientation: Cmd + L
* Toggle fullscreen: Control + Cmd + F

#### Actions

* Copy HTML: Option + Cmd + C
* Strong: Select text, Cmd + B
* Emphasize: Select text, Cmd + I
* Inline Code: Select text, Cmd + K
* Strikethrough: Select text, Cmd + U
* Link: Select text, Control + Shift + L
* Image: Select text, Control + Shift + I
* Select Word: Control + Option + W
* Select Line: Shift + Cmd + L
* Select All: Cmd + A
* Deselect All: Cmd + D
* Convert to Uppercase: Select text, Control + U
* Convert to Lowercase: Select text, Control + Shift + U
* Convert to Titlecase: Select text, Control + Option + U
* Convert to List: Select lines, Control + L
* Convert to Blockquote: Select lines, Control + Q
* Convert to H1: Cmd + 1
* Convert to H2: Cmd + 2
* Convert to H3: Cmd + 3
* Convert to H4: Cmd + 4
* Convert to H5: Cmd + 5
* Convert to H6: Cmd + 6
* Convert Spaces to Tabs: Control + [
* Convert Tabs to Spaces: Control + ]
* Insert Current Date: Control + Shift + 1
* Insert Current Time: Control + Shift + 2
* Insert entity <: Control + Shift + ,
* Insert entity >: Control + Shift + .
* Insert entity &: Control + Shift + 7
* Insert entity Space: Control + Shift + Space
* Insert Scriptogr.am Header: Control + Shift + G
* Shift Line Left: Select lines, Cmd + [
* Shift Line Right: Select lines, Cmd + ]
* New Line: Cmd + Return
* Comment: Cmd + /
* Hard Linebreak: Control + Return

#### Edit

* Auto complete current word: Esc
* Find: Cmd + F
* Close find bar: Esc

#### Post

* Post on Scriptogr.am: Control + Shift + S
* Post on Tumblr: Control + Shift + T

#### Export

* Export HTML: Option + Cmd + E
* Export PDF:  Option + Cmd + P


### And more?

Don't forget to check Preferences, lots of useful options are there.

Follow [@chenluois](http://twitter.com/chenluois) on Twitter for the latest news.

For feedback, use the menu `Help` - `Send Feedback`

@TODO: July 11th 2011

## GENERATOR FLOW

1. Client-side
2. RPC-Connector
3. Server-side


### CLIENT SIDE

	Step 1 - Client-side UI Info - What type of user interface should be created, flash/flex app, html ui, jquery mobile ui, etc.
	
		Types:
			1. Flex/Flash UI
			2. HTML/HTML5 UI
			3. jQuery Mobile UI
			4. WordPress Plugin UI
		
	Step 2 - JS Framework Info - What type of user interface framework is going to be used, backbone.js, cairngorm, other.
	
		Types:
			1. None - html/php
			2. Backbone.js - js/php
			3. Cairngorm - fx


### RPC CONNECTOR

	Step 1 - Client-to-Server Info - What type of RPC is going to be used to connect the client application to the server tier? 
		How is the client going to talk to the server.
		

	Step 2 - RPC Info - What is the information needed to connect to that service.
		Types:
			1. HTTPService - fx/php
			2. AMFPHP Service - fx/php
			3. REST JSON Service - php/backbone.js
			4. REST API Service - php/backbone.js
			5. Custom Service - unknown/service inspector will allow developer to add custom methods to the data connector.

	Step 3 - Model -> Table Relationships - Allow choice of tables and fields for each client side entity be optionaly selected, this allows more control over what code is generated.
		Types:
			1. Client-side Model Name->defaults, validation, view


### SERVER SIDE

	Step 1 - Database Info - The credentials for the data access layer, such as host, port, user, pass, database, etc.
		
		Types:
			1. SQLite - path, database,
			2. MySQL - host, port, user, pass, database
			3. CouchDB - host, port, user, pass, database
			4. JSON File - just the path to where to save the file is needed
	
	Step 2 - 





@TODO: July 10th 2011
1. Setup firebugPHP for debuging.
2. Finish converting all html views to jquery mobilized
3. Documentent any code not documentent
4. Create UI for data manager, utilities, and inspector
5. Move CodeGen over to Backbone.js framework for client side.
6. Add new app templates to be generated, 
  
Including:
 		jQuery Mobile Web App
 		jQuery Mobile Web App with backbone.js client side
 		Wordpress Plugin Web App
 		Wordpress Theme Web App


@TODO: Sept 29th 2009
 1. Fix all main generators to accept new parameters when generating code,
 if an array is passed as the options read from the array keys else read from the xml file.

 
@TODO: Sept 28th 2009
 
 
 
 1. When creating application make main folder name of the application. For flex import. with services folder inside of folder.
 2. Add new options for generation, including getters/setters
 REST url style
 API key use
 Admin Logging
 User monitoring
 Field alias, as well as uploading edited config and schema files.
 Field toggle display.

@TODO: July 11th 2009
  
 1. Edit php service template and add post switch statement on REST part.
 2. Add my jquery pages plugin to the main navigation of the site.
 3. Fix boxes to make all drag drop.
 4. Use 960.css style
 5. Create class to display recent updates to CodeGen repo
 6. Create automation script that downloads all the recent versions
 7. Create a update checker.
 8. Incorporate Flex service browser and api tester.
 9. Create sql schema export.
 10. Create class to find table relationships using rails method of
 		has_many:
 		has_one:
 		belongs_to:
 		has_and_belongs_to_many:
 		
  

@TODO: Auguest 7th 2009
1. Upon successful generation of flex application, save the information in the sqlite database cg_historys table