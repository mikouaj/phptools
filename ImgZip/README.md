# ImgZip
Simple class that creates zip archive with images from a specified folder for download

###About
Script requires PHP 5.2 or newer, uses ZipArchive to create zip file with images from a folder passed to the script as a parameter, then redirects page to make user download and removes it when done.
* imgzip - folder with a script
* testPage - simple page for testing purposes

###Usage
1. upload *imgzip* folder to __root__ directory of your webpage
2. upload your images to some dedicated folder in your webpage directory
3. add link to your html page that will reference to *imgzip/imgzipctrl.php* with *imgdir* parameter equal to images folder path i.e.:
```
<a href="imgzip/imgzipctrl.php?imgdir=somefolder/images"></a>
```