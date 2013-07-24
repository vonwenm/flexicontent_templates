flexicontent_templates
======================

Category and item templates for Flexicontent

<h2>json</h2>
Use this template to generate JSON or JSONP output for your category or item. The output is the database value, not the field display.

<b>Usage:</b>
- You need to copy the file raw.php to your Joomla template folder. This will prevent any HTML code to be added to the output.
- Install the json template in Flexicontent.
- In the template configuration add the fields you would like to output in the category and item views.
- Enable the json template in the content types you will be using.
- To view a category JSON output use:
http://domain.com/path/to/category?tmpl=raw&clayout=json
- To view a JSONP output just add a callback function parameter to the URL:
http://domain.com/path/to/category?tmpl=raw&clayout=json&callback=myfunc
- To view an item JSON output use:
http://domain.com/path/to/item?tmpl=raw&ilayout=json
- To view a JSONP output just add a callback function parameter to the URL:
http://domain.com/path/to/item?tmpl=raw&ilayout=json&callback=myfunc

Please note that the values used in the url for tmpl, clayout, and ilayout need to match the Joomla and Flexicontent template file/folder names.
