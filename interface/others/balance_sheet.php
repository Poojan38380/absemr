<?php
require("../globals.php");

// Enable error reporting for debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 1);


// Fetch existing entries
$sql = sqlStatement(
    "select * from patient_balance_sheet where pid = $pid order by id desc",
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

        h1 {
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .balance {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Balance Sheet</h1>

    <p>Manage patient balance sheet entries here.</p>
    <div class="flex justify-between m">
        <div>
            Current Balance: <strong>
                <?php
                $query = sqlStatement(
                    "SELECT balance from patient_balance_sheet where pid = $pid order by id desc limit 1",
                    []
                );
                $result = sqlFetchArray($query);
                echo $result['balance'];
                ?>
        </div>
        <div>
            <a href="index.php" class="btn btn-primary">Add New Entry</a>
        </div>
    </div>

    <!-- Add/Edit Form -->
    <form id="entryForm">
        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" required>
                <option value="CREDIT">CREDIT</option>
                <option value="DEBIT">DEBIT</option>
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" required />
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>

        <input type="submit" value="Add Entry" />
    </form>

    <!-- Existing Entries List -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Description</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = sqlFetchArray($sql)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['amount'] ?></td>
                    <td><?= $row['balance'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <script>document.getElementById('entryForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const data = {
                type: document.getElementById('type').value,
                amount: document.getElementById('amount').value,
                description: document.getElementById('description').value,
            };

            fetch('services/balancesheet.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(res => {
                    alert(res.message);
                    if (res.status === 'success') {
                        location.reload();
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                });
        });
    </script>
</body>

</html>