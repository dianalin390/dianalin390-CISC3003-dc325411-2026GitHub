<?php
/**
 * 输出订单表格的单行数据
 * @param string $file 商品封面图片路径
 * @param string $title 商品标题
 * @param int $quantity 商品数量
 * @param float $price 商品单价
 */
function outputOrderRow($file, $title, $quantity, $price) {
    // 计算当前商品的总金额
    $amount = $quantity * $price;
    // 格式化货币，保留2位小数
    $formattedPrice = number_format($price, 2);
    $formattedAmount = number_format($amount, 2);
    
    // 输出表格行HTML，完全匹配你的CSS类名
    echo <<<HTML
    <tr>
        <td><img src="{$file}" alt="{$title}" class="product-cover"></td>
        <td>{$title}</td>
        <td>{$quantity}</td>
        <td>\${$formattedPrice}</td>
        <td class="text-right">\${$formattedAmount}</td>
    </tr>
HTML;
}
?>