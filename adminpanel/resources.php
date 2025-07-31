<?php
include '../admin/db.php';

// Add Resource
if (isset($_POST['add_resource'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $category = $_POST['category'];

    $sql = "INSERT INTO resources (title, description, link, category) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $title, $description, $link, $category);
    $stmt->execute();
}

// Delete Resource
if (isset($_POST['delete_resource'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM resources WHERE id='$id'");
}

// Upload Image
if (isset($_POST['upload_image'])) {
    $page = $_POST['page'];
    $target_dir = "../assets/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "UPDATE site_images SET image_path='$target_file' WHERE page='$page'";
        $conn->query($sql);
    }
}

// Add Social Media Icon
if (isset($_POST['add_social'])) {
    $icon = $_POST['icon'];
    $link = $_POST['link'];
    $conn->query("INSERT INTO social_links (icon, link) VALUES ('$icon', '$link')");
}

// Delete Social Media Icon
if (isset($_POST['delete_social'])) {
    $id = $_POST['id'];
    $conn->query("DELETE FROM social_links WHERE id='$id'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Resources</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Arial", sans-serif;
        }
        body {
            display: flex;
            min-height: 100vh;
            background-color: #eef2f3;
            flex-direction: row;
        }

        /* Sidebar */
        .sidenav {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
            position: fixed;
            height: 100%;
            transition: all 0.3s ease;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            transition: margin-left 0.3s ease;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 26px;
        }

        h3 {
            margin-top: 20px;
            color: #34495e;
            font-size: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        form {
            background: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            background: #f9f9f9;
        }

        button {
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 6px;
            font-size: 16px;
            transition: 0.3s ease-in-out;
        }

        button:hover {
            background: #217dbb;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 16px;
        }

        table th {
            background-color: #2c3e50;
            color: white;
        }

        table tr:nth-child(even) {
            background: #f4f4f4;
        }

        a {
            text-decoration: none;
            color: #3498db;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .menu-toggle {
            display: none;
            position: absolute;
            left: 15px;
            top: 15px;
            font-size: 24px;
            cursor: pointer;
            color: white;
            background: none;
            border: none;
        }

        @media screen and (max-width: 768px) {
            .sidenav {
                width: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .menu-toggle {
                display: block;
            }

            .sidenav.open {
                width: 250px;
            }
            .main-content.open {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<?php include 'slidebar.php'; ?>

<!-- Main Content -->
<div class="main-content">
    <h1>Manage Resources</h1>

    <!-- Upload Image -->
    <h3>Change Website Images</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Select Page:</label>
        <select name="page">
            <option value="index">Homepage</option>
            <option value="blog">Blog Page</option>
        </select>
        <input type="file" name="image" required>
        <button type="submit" name="upload_image">Upload</button>
    </form>

    <!-- Add Social Media -->
    <h3>Manage Footer Social Links</h3>
    <form action="" method="POST">
        <input type="text" name="icon" placeholder="FontAwesome Icon (e.g., fab fa-facebook)" required>
        <input type="url" name="link" placeholder="Social Media URL" required>
        <button type="submit" name="add_social">Add Link</button>
    </form>

    <!-- Add Resources -->
    <h3>Manage Resources</h3>
    <form action="" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="url" name="link" placeholder="Resource Link" required>
        <input type="text" name="category" placeholder="Category" required>
        <button type="submit" name="add_resource">Add Resource</button>
    </form>

    <!-- Display Resources -->
    <h3>Existing Resources</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Link</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php
        include '../admin/db.php';
        $result = $conn->query("SELECT * FROM resources");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td><a href='{$row['link']}' target='_blank'>View</a></td>
                    <td>{$row['category']}</td>
                    <td>
                        <form action='' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' name='delete_resource'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Display Social Media Links -->
    <h3>Existing Social Media Links</h3>
    <table>
        <tr>
            <th>Icon</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
        <?php
        $socials = $conn->query("SELECT * FROM social_links");
        while ($row = $socials->fetch_assoc()) {
            echo "<tr>
                    <td><i class='{$row['icon']}'></i></td>
                    <td><a href='{$row['link']}' target='_blank'>{$row['link']}</a></td>
                    <td>
                        <form action='' method='POST'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' name='delete_social'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButton = document.querySelector(".menu-toggle");
        const sidebar = document.querySelector(".sidenav");
        const mainContent = document.querySelector(".main-content");

        if (toggleButton) {
            toggleButton.addEventListener("click", function () {
                sidebar.classList.toggle("open");
                mainContent.classList.toggle("open");
            });
        }
    });
</script>

</body>
</html>
