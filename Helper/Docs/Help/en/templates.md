# Templates

Templates are the basis for every helper. They can be defined in such a way that they don't need additional uploaded by using already available data stored in database, the web etc. or in such a way which requires user uploaded data whenever it should create a new output.

## File types

When creating a template the following file endings have special meaning:

* \*.tpl.php - This is the user interface the user sees when he opens a helper
* \*.lang.php - This is the language file which can be used for different localizations
    * The * needs to be replaced with 2 character language codes such as `en` for english

* Export
    * \*.pdf.php - This allows the user to create a pdf export (e.g. for reports)
    * \*.xls.php - This allows the user to create a excel export (e.g. for reports or data analysis)
    * \*.doc.php - This allows the user to create a word export (e.g. for reports or mailings)
    * \*.ppt.php - This allows the user to create a powerpoint export (e.g. for reports)
    * \*.json.php - This allows the user to create a json export
    * \*.csv.php - This allows the user to create a csv export

* \*.css - This can be used in order to define helper specific designs which can be used in the `*.tpl.php`
* \*.js - This can be used in order to define helper specific frontend interactions which can be used in the `*.tpl.php`

Other file endings can be used as well but they don't have a special meaning for the template.

## Standalone

By defining a helper `standalone` no additional user upload is required after the creation of a new helper. This is often useful if the helper is using global data stored in databases. If the template is not `standalone` the user needs to upload additional data whenever he wants to create a new output. This is helpful whenever large amounts of user input is required and therefore makes more sense to be provided as file uploads.

## Media

When creating a new template it's also possible to use already uploaded media files. This allows users to re-use existing data and files. As a result if multiple helpers share some files these files only need to be updated once if required instead of changing them for every implemented helper. A common example are database connection information or general purpose settings and definitions.

### Expected

If the template is not `standalone` the user also has to define what kind of file names he expects to be uploaded when a new output should be created by the helper. Only specified file names will be uploaded and used.

Expected user uploads can be defined via `regex` like this:

* \*.csv - This means all files with the ending `.csv` are valid (at least one such file must be uploaded)
* testfile\.txt - This means at least one file with the name `testfile.txt` has to be uploaded
* testfile\-([0-9]+)\.csv - this means at least one file with the name `testfile-{any_number}.txt` has to be uploaded.