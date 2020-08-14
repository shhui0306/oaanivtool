# OA週年倒數小工具  Anniversary Countdown Tool (by KYOMA)

本工具提供On Air!的週年倒數，亦可以改為其他活動的倒數。

## 範例
（オンエア二周年同人企劃）https://oa1anniversary.wixsite.com/oa2a/blank

## 內容
countdown.php: 倒數清單，存放倒數內容，請按照修改  
index.php: 倒數頁  
list.php: 倒數回顧列表  
story.php: 週年當天發佈內容  
datecompare.php: 日期比對函數  
css: 網頁格式用  

## 使用指引
### datecompare.php
請修改以下常數(constant)，其餘函數如無問題請勿修改
FIRSTDAY：倒數第一天
ANNIVDATE：週年當天
COUNTDAYS：總共倒數天數（包括週年當天）  

### countdown.php
- $countdownlist： 倒數內容，格式如下
```
[
        [
            "date" => "（出場日期）",
            "charaName" => "（角色名）",
            "isSenpai" => （是否前輩，true/false）,
            "message" => "（中文信息）",
            "message_jp" => "（日文信息）",
            "unit" => "（組合簡稱）",
            "goodscreator" => "（祭壇負責人，如沒有可填null）",
            "illustcreator" => "（賀圖負責人，如沒有可填null）",
           "goodslink"=>"（祭壇連結）",
           "illustlink"=>"（賀圖連結）",
            "id" => （倒數第幾天，從1開始）,
        ],...
]
```
- $unitnames：組合名稱，格式如下
```
["（組合簡稱）"=>"（組合名稱全寫）",...]
```

- $unitdates： 組合出場日期，用於list.php列表，格式如下
```
["（組合簡稱）"=>"（組合中第一個登場日期）",...
"all"=>"（週年當天）"]
```

- $unitdates： 組合圖連結，用於list.php列表，格式如下
```
["（組合簡稱）"=>"（連結）",...]
```

### index.php, list.php
試驗時可修改 $today = "2021-8-17"; 此行， 正式發佈時請確保將此行註釋(comment)，以便倒數時採用伺服器時間比對。

### story.php
請插入週年當日的公佈內容

## 版權
《オンエア！》由Coly inc.所有。 (https://colyinc.com/)  
本程式只使用角色名稱及團體名。  
本程式是同人企劃的一部分，與オンエア！開發方沒有任何關聯。  

## Copyright
"On Air!" is owned by Coly inc. (https://colyinc.com/)  
Only character names and unit names are used in this project.  
This project is part of a fan project, with no affiliations with developers of "On Air!".  