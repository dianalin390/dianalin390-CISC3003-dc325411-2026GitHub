<?php
/**
 * 读取客户数据文件，返回结构化的客户数组
 * @param string $filename 客户数据文件的完整路径
 * @return array 客户数据，键为客户ID，值为客户信息关联数组
 */
function readCustomers($filename) {
    $customers = [];
    // 校验文件是否存在且可读
    if (!file_exists($filename) || !is_readable($filename)) {
        return $customers;
    }
    // 逐行读取文件
    $fileHandle = fopen($filename, 'r');
    if ($fileHandle) {
        while (($line = fgets($fileHandle)) !== false) {
            $trimmedLine = trim($line);
            // 跳过空行
            if (empty($trimmedLine)) {
                continue;
            }
            // 按分号分割字段
            $fields = explode(';', $trimmedLine);
            // 校验字段完整性
            if (count($fields) < 12) {
                continue;
            }
            // 清洗并结构化客户数据
            $customerId = trim($fields[0]);
            $customers[$customerId] = [
                'id'         => $customerId,
                'first_name' => trim($fields[1]),
                'last_name'  => trim($fields[2]),
                'email'      => trim($fields[3]),
                'university' => trim($fields[4]),
                'address'    => trim($fields[5]),
                'city'       => trim($fields[6]),
                'state'      => trim($fields[7]),
                'country'    => trim($fields[8]),
                'zip'        => trim($fields[9]),
                'phone'      => trim($fields[10]),
                'sales'      => trim($fields[11])
            ];
        }
        fclose($fileHandle);
    }
    return $customers;
}

/**
 * 读取指定客户的订单数据
 * @param string|int $customerId 目标客户ID
 * @param string $filename 订单数据文件的完整路径
 * @return array 该客户的订单数组，无订单返回空数组
 */
function readOrders($customerId, $filename) {
    $orders = [];
    $targetCustomerId = trim($customerId);
    // 校验参数和文件有效性
    if (empty($targetCustomerId) || !file_exists($filename) || !is_readable($filename)) {
        return $orders;
    }
    // 逐行读取订单文件
    $fileHandle = fopen($filename, 'r');
    if ($fileHandle) {
        while (($line = fgets($fileHandle)) !== false) {
            $trimmedLine = trim($line);
            if (empty($trimmedLine)) {
                continue;
            }
            // 按逗号分割订单字段
            $fields = explode(',', $trimmedLine);
            if (count($fields) < 5) {
                continue;
            }
            // 匹配客户ID
            $orderCustomerId = trim($fields[1]);
            if ($orderCustomerId === $targetCustomerId) {
                $orders[] = [
                    'order_id'   => trim($fields[0]),
                    'customer_id'=> $orderCustomerId,
                    'isbn'       => trim($fields[2]),
                    'title'      => trim($fields[3]),
                    'category'   => trim($fields[4])
                ];
            }
        }
        fclose($fileHandle);
    }
    return $orders;
}
?>