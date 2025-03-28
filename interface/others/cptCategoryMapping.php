<?php
require("../globals.php");

// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);


// Fetch existing entries
$sql = sqlStatement(
    "SELECT * from cpt_category_mapping",
    []
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Category Mapping Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="submit"] {
            margin: 5px 0;
            padding: 5px;
            width: 100%;
        }

        .actions a {
            margin-right: 10px;
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>
    <h1>Category Mapping Management</h1>

    <!-- Add/Edit Form -->
    <form onsubmit="handleSubmit(event)">
        <?php
        if (isset($_GET['id'])) { ?>
            <input type='hidden' id='id' name='id' value='<?php echo $_GET['id']; ?>'>
        <?php } ?>

        <label for="cpt4code">CPT Category:</label>
        <input type="text" name="cpt4code" id="cpt4code" required
            value="<?php echo isset($_GET['cpt4code']) ? $_GET['cpt4code'] : ''; ?>">

        <label for="category">Category Name:</label>
        <input type="text" name="category" id="category" required
            value="<?php echo isset($_GET['category']) ? $_GET['category'] : ''; ?>">

        <input type="submit" name="<?php echo isset($_GET) ? 'update' : 'add'; ?>"
            value="<?php echo isset($_GET['id']) ? 'Update' : 'Add'; ?> Entry">
    </form>

    <!-- Existing Entries List -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CPT Category</th>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlFetchArray($sql)): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['cpt4code']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td class="actions">
                        <a
                            href="cptCategoryMapping.php?id=<?php echo $row['id']; ?>&cpt4code=<?php echo $row['cpt4code']; ?>&category=<?php echo $row['category']; ?>&edit=true">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>
        // Handle form submission
        function handleSubmit(e) {
            console.log('Form submitted');
            e.preventDefault();


            const data = {
                cpt4code: document.getElementById('cpt4code').value,
                category: document.getElementById('category').value,
            };
            data.<?php echo (isset($_GET['id']) ? 'update' : 'add') ?> = '<?php echo (isset($_GET['id']) ? 'Update' : 'Add') ?>';
            <?php if (isset($_GET['id'])) { ?>
                data.id = document.getElementById('id').value;
            <?php } ?>

            fetch('services/process.php', {
                method: 'POST',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>

<!-- process.php -->
<?php
// Handle Add
if (isset($_POST['add'])) {
    $cpt4code = $conn->real_escape_string($_POST['cpt4code']);
    $category = $conn->real_escape_string($_POST['category']);

    $sql = "INSERT INTO cpt_category_mapping (cpt4code, category) 
            VALUES ('$cpt4code', '$category')";

    if ($conn->query($sql)) {
        header("Location: index.php?msg=added");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['id']);
    $cpt4code = $conn->real_escape_string($_POST['cpt4code']);
    $category = $conn->real_escape_string($_POST['category']);

    $sql = "UPDATE cpt_category_mapping 
            SET cpt4code = '$cpt4code', 
                category = '$category' 
            WHERE id = '$id'";

    if ($conn->query($sql)) {
        header("Location: index.php?msg=updated");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delete_id = $conn->real_escape_string($_GET['delete']);

    $sql = "DELETE FROM cpt_category_mapping WHERE id = '$delete_id'";

    if ($conn->query($sql)) {
        header("Location: index.php?msg=deleted");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>