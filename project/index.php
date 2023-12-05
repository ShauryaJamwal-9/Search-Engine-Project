<?php
    $conn = new mysqli("localhost","root","admin","search_engine");
    $result = [];
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
        $keyword = substr($keyword,0,2);
        $keyword .="%";
        $sql = "select * from keywords_url where keywordname LIKE \"".$keyword."\"";
        // echo $sql;
        $result = $conn->query($sql);
        // echo $sql;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shaurya Jamwal Search Engine</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <h1 class="page-header text-center p-4">Search Engine</h1>
    <form class="container row" style="margin: 0 auto;" method="GET">
        <div class="col-sm-12 row">
            <label class="col-sm-4">Search keyword</label>
            <input type="search" name="keyword" class="col-sm-6 form-control">
            <input type="submit" value="search" class="btn btn-primary my-2">
        </div>
    </form>

    <?php
        if ( isset($result->num_rows) && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $links = $row["url"];
                ?>
                <div class="container p-2">
                    <a href="<?php echo $links;?>"><?php echo $title;?></a><br>
                    <small> <?php echo $links;?> </small>
                </div>
                <br>
            <?php
            }
        } 
        else{ ?>
            <h4>Start Searching</h4>
        <?php }
    ?>  
    
</body>
</html>