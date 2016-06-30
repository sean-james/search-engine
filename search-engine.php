// There are a few changes  to PHP5 or upgrading to PHP 7. If you code with PHP5 with a newer version of MySQL, it's strongly recommended for you to use the extension “mysqli” over “mysql” this ultimately now includes PHP7.

<?php
 
$button = $_GET ['submit'];
$search = $_GET ['search']; 
 
if(!$button)
echo "Submit a keyword";
else
{
if(strlen($search)<=1)
echo "Search term too short";
else{
echo "You searched for <b>$search</b> <hr size='1'></br>";
$link = mysqli_connect("mysql host", "username", "password", "db name") 
    or die ("couldn't connect to server" . mysqli_error()); 
 
$search_exploded = explode (" ", $search);
 
foreach($search_exploded as $search_each)
{
$x++;
if($x==1)
$construct .="keywords LIKE '%$search_each%'";
else
$construct .="AND keywords LIKE '%$search_each%'";
 
}
 
$query ="SELECT * FROM YOUR TABLE NAME WHERE ".$construct;
$run = mysqli_query( $link, $query ); 
    
 
$foundnum = mysqli_num_rows($run);

 
if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. Try different words with similar
 meaning</br>2. Please check your spelling";
else
{
echo "$foundnum results found !<p>";
 
while($runrows = mysqli_fetch_assoc($run))
{
$title = $runrows ['title'];
$desc = $runrows ['description'];
$url = $runrows ['url'];
 
echo "
<a href='$url'><b>$title</b></a><br>
$desc<br>
<a href='$url'>$url</a><p>
";
 
}
}
 
}
}
 
?>
