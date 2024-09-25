<div class="col-md-2">
	<div class="list-group">
		
		<a class="list-group-item" ><h1 class="cat-title">Category</h1></a>
 <?php

		function buildcategory($parent) {

			$html = "";
			$conn = new mysqli("localhost", "root", "", "bazaar");
			$stmt = $conn->prepare("SELECT id, label, link, parent FROM category");
			$stmt->execute();
			$result = $stmt->get_result();

			$category = array(
				'items' => array(),
				'parents' => array()
			);

			while ($row = $result->fetch_assoc()) {
				$category['items'][$row['id']] = $row;
				$category['parents'][$row['parent']][] = $row['id'];
			}

			$stmt->close();
			$conn->close();
			
			foreach ($category['parents'][$parent] as $itemId) {
				if (!isset($category['parents'][$itemId])) {
					$html .= "<a href='products.php?op=list&cat=" . $category['items'][$itemId]['id'] . "' class='list-group-item'>" . $category['items'][$itemId]['label'] . "</a>";
				}
				if (isset($category['parents'][$itemId])) {
					$html .= "
             <a href='products.php?op=list&cat=" . $category['items'][$itemId]['id'] . "' class='list-group-item'>" . $category['items'][$itemId]['label'] . "</a>";
					$html .= buildcategory($itemId, $category);

				}
			}

			return $html;
		}

		echo buildcategory(0);
		// ?>
		
	</div>
</div>