<!DOCTYPE HTML>
<html>
<head>
<title> ToDo List </title>
<p1> TO DO LIST </p1>
    <style type = "text/css">
        p1{font-size: 40px;}
        p1{color: black;}

    </style>
    <style>
        .remove-button 
        {

            color: red;
            background-color: white;
            border: 3px solid red;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost','root','', 'todolist');

    if (!$conn)
    {
        die ("The connection was not successful." .mysqli_connect_error());
        //If connection was not successful page will come up with error URL
    }

    if ($_SERVER['REQUEST_METHOD']==='POST') 
    {
    
        $title=$_POST['title'];

        $description=$_POST['description'];

        $SQL = "INSERT INTO todoitems (Title, Description) VALUES ('$title', '$description')";
        
        mysqli_query($conn,$SQL);

    }

    if (isset($_GET['remove']))
    {
        $itemNum = $_GET['remove'];

        $SQL = "DELETE FROM todoitems WHERE ItemNum = $itemNum";

        mysqli_query($conn,$SQL);

    }

    $SQL = "SELECT * FROM todoitems";

    $result = mysqli_query($conn,$SQL);

    if (mysqli_num_rows($result) > 0)
    {
        while ($row = mysqli_fetch_assoc($result))

        {
            $itemNum = $row['ItemNum'];

            $title = $row['Title'];

            $description=$row['Description'];

            echo "<p>$title: $description <span class = 'remove-button'  onclick=\"window.location.href='index.php?remove=$itemNum'\">X</span></p>";
        
        }

    }
    else
    {
        echo "No to do list items exist yet.";
    }

    mysqli_close($conn);

    ?>


        <form method = "POST" action = "index.php">
            <style type = "text/css">
                form{width: 40%;}
                form{margin: center;}
                form{border: 4px solid black;}
                form{color: black;}
                form{font-size: 20px;}
            </style>
            <label for="title">Title: </label>
            <input type="text" id = "title"name = "title" required maxlength= "20"> <br> <br> <br>
            <label for ="description"> Description:</label>
            <input type = "text" id = "description" name = "description" required maxlength = "50"><br><br>
             <input type="submit" value="Add". >

        </form>

        <h2> Add Item </h2>
    <style type = "text/css">
        h2{width: 20%;}
        h2{margin-left: 50px;}
        h2{background-color: white;}
        h2{border: 4px solid black;}
        h2{color: yellow;}
        h2{font-size: 40px;}
    </style>
</body>
</html>


        