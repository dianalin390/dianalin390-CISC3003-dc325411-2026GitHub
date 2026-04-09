<?php
// 引入核心工具函数
include 'includes/book-utilities.inc.php';

// 读取全量客户数据
$customerList = readCustomers('data/customers.txt');

// 处理URL中的客户ID参数，获取选中客户和对应订单
$selectedCustomerId = isset($_GET['customer_id']) ? trim($_GET['customer_id']) : null;
$selectedCustomer = null;
$customerOrders = [];
if ($selectedCustomerId && isset($customerList[$selectedCustomerId])) {
    $selectedCustomer = $customerList[$selectedCustomerId];
    $customerOrders = readOrders($selectedCustomerId, 'data/orders.txt');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CISC3003 Suggested Exercise 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <!-- 按需求引入两个样式文件 -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/demo-styles.css">
    <link rel="stylesheet" href="css/material.min.css">
    
    <script src="https://code.jquery.com/jquery-1.7.2.min.js" ></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script src="js/jquery.sparkline.2.1.2.js"></script>
</head>
<body>
    
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
            mdl-layout--fixed-header">
            
    <?php include 'includes/header.inc.php'; ?>
    <?php include 'includes/left-nav.inc.php'; ?>
    
    <main class="mdl-layout__content mdl-color--grey-50">
        <section class="page-content">
            <div class="mdl-grid">
              <!-- 客户列表卡片 -->
              <div class="mdl-cell mdl-cell--7-col card-lesson mdl-card  mdl-shadow--2dp">
                <div class="mdl-card__title mdl-color--orange">
                  <h2 class="mdl-card__title-text">Customers</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    <table class="mdl-data-table  mdl-shadow--2dp">
                      <thead>
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric">Name</th>
                          <th class="mdl-data-table__cell--non-numeric">University</th>
                          <th class="mdl-data-table__cell--non-numeric">City</th>
                          <th>Sales</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($customerList as $customer): ?>
                        <tr>
                          <td class="mdl-data-table__cell--non-numeric">
                            <!-- 客户名称带查询字符串的跳转链接 -->
                            <a href="cisc3003-sugex10-after.php?customer_id=<?= htmlspecialchars($customer['id']) ?>">
                                <?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?>
                            </a>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric">
                              <?= htmlspecialchars($customer['university']) ?>
                          </td>
                          <td class="mdl-data-table__cell--non-numeric">
                              <?= htmlspecialchars($customer['city']) ?>
                          </td>
                          <td>
                            <!-- Sparkline销售数据柱状图容器 -->
                            <span class="inlinesparkline"><?= htmlspecialchars($customer['sales']) ?></span>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                </div>
              </div>  <!-- /客户列表卡片 -->
              
              
            <div class="mdl-grid mdl-cell--5-col">
    
       
                  <!-- 客户详情卡片 -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Customer Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <?php if ($selectedCustomer): ?>
                            <!-- 选中客户时展示详情 -->
                            <h4><?= htmlspecialchars($selectedCustomer['first_name'] . ' ' . $selectedCustomer['last_name']) ?></h4>
                            <p><strong>Email:</strong> <?= htmlspecialchars($selectedCustomer['email']) ?></p>
                            <p><strong>University:</strong> <?= htmlspecialchars($selectedCustomer['university']) ?></p>
                            <p>
                                <strong>Address:</strong> 
                                <?php
                                // 拼接地址，过滤空字段，避免多余逗号
                                $addressSegments = [
                                    $selectedCustomer['address'],
                                    $selectedCustomer['city'],
                                    $selectedCustomer['state'],
                                    $selectedCustomer['country'],
                                    $selectedCustomer['zip']
                                ];
                                $addressSegments = array_filter($addressSegments, fn($val) => !empty(trim($val)));
                                echo htmlspecialchars(implode(', ', $addressSegments));
                                ?>
                            </p>
                            <p><strong>Phone:</strong> <?= htmlspecialchars($selectedCustomer['phone']) ?></p>
                        <?php else: ?>
                            <!-- 未选中客户时的默认提示 -->
                            <p>Select a customer to view details.</p>
                        <?php endif; ?>
                    </div>    
                  </div>  <!-- /客户详情卡片 -->   
                  <!-- 订单详情卡片 -->
                  <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-color--deep-purple mdl-color-text--white">
                      <h2 class="mdl-card__title-text">Order Details</h2>
                    </div>
                    <div class="mdl-card__supporting-text">       
                               
                               <table class="mdl-data-table  mdl-shadow--2dp">
                              <thead>
                                <tr>
                                  <th class="mdl-data-table__cell--non-numeric">Cover</th>
                                  <th class="mdl-data-table__cell--non-numeric">ISBN</th>
                                  <th class="mdl-data-table__cell--non-numeric">Title</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if ($selectedCustomer): ?>
                                    <?php if (!empty($customerOrders)): ?>
                                        <!-- 有订单时循环输出 -->
                                        <?php foreach ($customerOrders as $order): ?>
                                        <tr>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <!-- 图书封面，使用Open Library公开API -->
                                              <img src="https://covers.openlibrary.org/b/isbn/<?= htmlspecialchars($order['isbn']) ?>-S.jpg" 
                                                   alt="Book Cover" style="width: 50px; height: auto; border-radius: 4px;">
                                          </td>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <?= htmlspecialchars($order['isbn']) ?>
                                          </td>
                                          <td class="mdl-data-table__cell--non-numeric">
                                              <?= htmlspecialchars($order['title']) ?>
                                          </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <!-- 无订单时的提示 -->
                                        <tr>
                                            <td colspan="3" class="mdl-data-table__cell--non-numeric">
                                                No orders for this customer.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <!-- 未选中客户时的默认提示 -->
                                    <tr>
                                        <td colspan="3" class="mdl-data-table__cell--non-numeric">
                                            Select a customer to view order details.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                              </tbody>
                            </table>
       
                        </div>    
                   </div>  <!-- /订单详情卡片 -->             
               </div>   
           
           
            </div>  <!-- /mdl-grid -->    
        </section>
    </main>    
</div>    <!-- /mdl-layout --> 

<!-- Sparkline图表初始化 -->
<script>
$(document).ready(function() {
    // 初始化销售数据的柱状图，匹配示例样式
    $('.inlinesparkline').sparkline('html', {
        type: 'bar',
        barColor: '#3f51b5',
        height: '20px',
        barWidth: 4,
        barSpacing: 2
    });
});
</script>
          
</body>
</html>