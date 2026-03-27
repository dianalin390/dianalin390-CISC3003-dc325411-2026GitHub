<?php
// 强制开启PHP错误显示，所有错误都会打印在页面上
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 顶部先引入所有依赖文件
include 'data.inc.php';
include 'functions.inc.php';
// 计算订单合计数据（严格按照作业要求的规则）
// 1. 计算商品小计总和
$subtotal = ($quantity1 * $price1) + ($quantity2 * $price2) + ($quantity3 * $price3) + ($quantity4 * $price4);
// 2. 计算运费：满10000运费100，否则200
$shipping = $subtotal > 10000 ? 100 : 200;
// 3. 计算订单总金额
$grandTotal = $subtotal + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CISC3003 Practice 09</title>
<!-- 引入Material Icons（你的图标必须加这个，否则不显示） -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- 引入你写好的CSS -->
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="app-container">
<!-- 引入左侧侧边栏 -->
<?php include 'left.inc.php'; ?>
<!-- 右侧主内容区 -->
<div class="main-content">
<!-- 引入顶部导航栏（修改点1：改为 header.php） -->
<?php include 'header.php';?>
<!-- 内容标题区 -->
<div class="content-header">
<h4>Order Summaries</h4>
<p>Examine your customer orders</p>
</div>
<!-- 双卡片容器 -->
<div class="cards-container">
<!-- 我的订单卡片 -->
<div class="card card-orders">
<div class="card-header">
<h4>My Orders</h4>
</div>
<div class="card-content">
<!-- 作业要求：用for循环输出订单列表 -->
<ul class="order-list">
<?php
$orderCount = count($orderList);
for ($i = 0; $i < $orderCount; $i++) {
echo '<li class="order-item"><a href="#">Order ' . $orderList[$i] . '</a></li>';
}
?>
</ul>
</div>
</div>
<!-- 订单详情卡片 -->
<div class="card card-order-detail">
<div class="card-header">
<h4>Selected Order: #520</h4>
</div>
<div class="card-content">
<div class="customer-info">
Customer: Mount Royal University
</div>
<!-- 订单表格 -->
<table class="order-table">
<thead>
<tr>
<th>Cover</th>
<th>Title</th>
<th>Quantity</th>
<th>Price</th>
<th class="text-right">Amount</th>
</tr>
</thead>
<tbody>
<!-- 作业要求：调用函数输出4行商品数据（修改点2：$product改为$title） -->
<?php
outputOrderRow($file1, $title1, $quantity1, $price1);
outputOrderRow($file2, $title2, $quantity2, $price2);
outputOrderRow($file3, $title3, $quantity3, $price3);
outputOrderRow($file4, $title4, $quantity4, $price4);
?>
<!-- 小计行 -->
<tr class="totals">
<td colspan="4" class="text-right">Subtotal</td>
<td class="text-right">$<?php echo number_format($subtotal, 2); ?></td>
</tr>
<!-- 运费行 -->
<tr class="totals">
<td colspan="4" class="text-right">Shipping</td>
<td class="text-right">$<?php echo number_format($shipping, 2); ?></td>
</tr>
<!-- 总计行 -->
<tr class="grandtotals">
<td colspan="4" class="text-right">Grand Total</td>
<td class="text-right">$<?php echo number_format($grandTotal, 2); ?></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</body>
</html>