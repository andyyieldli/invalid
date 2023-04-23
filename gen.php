<?php
ini_set('date.timezone','Asia/Bangkok');
$bizTurnOverId = "1860134582" . date('Ymd');
$accountId = 8;
$subAccountId = 8;
$subAccountType = 'MONEY_ACCOUNT';
$bizMerchantId = 1356106212966682625;
$changeType = 'TOP_UP_INCOMING';
$currency = 'IDR';
$preCashAmount = $argv[1];
$changeCashAmount = $argv[2];
$platformFee = 0.0000;
$channelFee = 0.0000;
$vatFee = 0.0000;
$afterCashAmount = floatval($preCashAmount + $changeCashAmount);
$applicationId = $bizTurnOverId;
$applicationType = 'TOP UP';
$bankCode = '014';
$remark = 'BBB Marketing Fees';
$transactionTime = date('Y-m-d H:i:s');
$status = 'COMPLETED';


$cashSql = "INSERT INTO `sub_account_cash_turnover` (`biz_turnover_id`, `account_id`, `sub_account_id`, `sub_account_type`, `biz_merchant_id`, `change_type`, `currency`, `pre_cash_amount`, `change_cash_amount`, `platform_fee`, `channel_fee`, `vat_fee`, `after_cash_amount`, `application_id`, `application_type`, `bank_code`, `remark`, `transaction_time`, `status`) ";
$cashSql .= " VALUES ({$bizTurnOverId}, {$accountId}, {$subAccountId}, '{$subAccountType}', {$bizMerchantId}, '{$changeType}', '{$currency}', {$preCashAmount}, {$changeCashAmount}, {$platformFee}, {$channelFee}, {$vatFee}, {$afterCashAmount}, {$applicationId}, '{$applicationType}', '{$bankCode}', '{$remark}', '{$transactionTime}', '{$status}');";
file_put_contents('/tmp/topup.sql', $cashSql."\n");

$subAccountSql = "update sub_account set cash_amount = cash_amount + {$changeCashAmount}, amount = amount + {$changeCashAmount} where biz_merchant_id={$bizMerchantId};";
file_put_contents('/tmp/topup.sql', $subAccountSql."\n", FILE_APPEND);

