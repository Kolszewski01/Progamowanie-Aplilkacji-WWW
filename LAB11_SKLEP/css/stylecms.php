<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}
h1, h2 {
    color: #333;
}
.container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.section {
    background: #fff;
    padding: 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    flex-basis: 48%;
    box-sizing: border-box;
}
.section h2 {
    margin-bottom: 20px;
}
form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}
label {
    display: block;
    margin-top: 10px;
}
input[type="text"],
input[type="password"],
input[type="number"],
textarea {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type="submit"] {
    background-color: #007BFF;
    color: white;
    border: none;
    padding: 10px 15px;
    margin-top: 15px;
    border-radius: 4px;
    cursor: pointer;
}
input[type="submit"]:hover {
    background-color: #0056b3;
}
.button-link, .button-delete {
    padding: 5px 10px;
    text-decoration: none;
    color: white;
    border-radius: 5px;
    font-size: 14px;
    display: inline-block;
    margin-right: 10px;
}
.button-link {
    background-color: #4CAF50;
}
.button-link:hover {
    background-color: #45a049;
}
.button-delete {
    background-color: #f44336;
}
.button-delete:hover {
    background-color: #da190b;
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.data-table th, .data-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
.data-table th {
    background-color: #f2f2f2;
}
.data-table tr:nth-child(even) {
    background-color: #f9f9f9;
}
</style>
