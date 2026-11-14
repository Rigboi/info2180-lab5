<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$country = $_GET['country'] ?? "";
$searchType = $_GET['lookup']  ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
if ($searchType === 'cities') {
  $stmt = $conn -> prepare(
    "SELECT c.name, c.district, c.population
    FROM cities AS c
    JOIN countries as co on c.country_code = co.code
    WHERE co.name LIKE :country"
  );
}
else {
   $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
}
$stmt -> execute(['country' => '%' . $country. '%']);



$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

 <table>
  <thead>
  <tr>
    <?php if ($searchType === 'cities'): ?>
      <th>Name</th>
      <th>District</th>
      <th>Population</th>
    <?php else: ?>
      <th>Country Name</th>
      <th>Continent</th>
      <th>Independence Year</th>
      <th>Head of State</th>
    <?php endif; ?>
  </tr>
</thead>



<tbody>
  <?php foreach ($results as $row): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>

      <?php if ($searchType === 'cities'): ?>
        <td><?= htmlspecialchars($row['district']) ?></td>
        <td><?= htmlspecialchars((string) $row['population']) ?></td>
      <?php else: ?>
        <td><?= htmlspecialchars($row['continent']) ?></td>
        <td><?= htmlspecialchars((string) ($row['independence_year'] ?? '')) ?></td>
        <td><?= htmlspecialchars($row['head_of_state'] ?? '') ?></td>
      <?php endif; ?>
    </tr>
  <?php endforeach; ?>
</tbody>


 </table>