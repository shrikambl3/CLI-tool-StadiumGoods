# CLI-tool-StadiumGoods
CLI tool that will accept a url for a StadiumGoods product listing page (PLP) and output a csv

Files:
  simple_html_dom - PHP HTML DOM parser library
  index - Custom file for the tool
  
Instructions:
  1 - Go to the file directory of the index.php file
  2 - Run the file from command line and by providing URL as the first argument.
  example : php index.php urlname
  
Sample CLI input
  php index.php https://www.stadiumgoods.com/nike 
  (If url is not provided it will throw an error)
  
Sample url with output:
  Success
    url - https://www.stadiumgoods.com/nike
  Error
    Die with 404 - https://www.stadiumgoods.com/test
    Not on product page - https://www.stadiumgoods.com/customer/account/login/
  
