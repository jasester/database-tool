<?php

namespace Hnndy\DatabaseTool;

use Illuminate\Support\Facades\DB;

class DatabaseTool 
{
    /**
     * 获取数据库中所有的表
     * @return array
     */
	public function getDatabaseTables ()
	{
        $dbtables = DB::select('SHOW TABLE STATUS');

        $total = 0;

        foreach ($dbtables as $k => $v)
        {
            $dbtables[$k]->size = $this->format_bytes($v->Data_length + $v->Index_length);
            $total += $v->Data_length + $v->Index_length;
            $tables[] = $v->Name;
        }

        $this->tables = $tables;

        return [
            'statue' => 'success',
            'message' => '获取成功！',
            'results' => $dbtables,
            'total' => $this->format_bytes($total)
        ];
	}

    /**
     * 优化表
     * @param $tablename 数组或字符串
     * @return array
     */
    public function optimize ($tablename)
    {
        if (is_array($tablename))
        {
            $optimizes = collect($tablename)->map(function ($name) {
                return DB::select("OPTIMIZE TABLE {$name} ");
            })->flatten(1)->toArray();
            return [
                'statue' => 'success',
                'message' => '优化成功！',
                'result' => $optimizes
            ];
        }
        else
        {
            if($optimize = DB::select("OPTIMIZE TABLE {$tablename} "))
            {
                return [
                    'statue' => 'success',
                    'message' => '优化成功！',
                    'result' => $optimize
                ];
            }
            return [
                'statue' => 'error',
                'message' => '优化失败！',
            ];
        }
	}

    /**
     * 修复表
     * @param $tablename 数组 或 字符串
     * @return array
     */
    public function repair ($tablename)
    {
        if (is_array($tablename))
        {
            $optimizes = collect($tablename)->map(function ($name) {
                return DB::select("REPAIR TABLE {$name} ");
            })->flatten(1)->toArray();
            return [
                'statue' => 'success',
                'message' => '修复成功！',
                'result' => $optimizes
            ];
        }
        else
        {
            if($optimize = DB::select("REPAIR TABLE {$tablename} "))
            {
                return [
                    'statue' => 'success',
                    'message' => '修复成功！',
                    'result' => $optimize
                ];
            }
            return [
                'statue' => 'error',
                'message' => '修复失败！',
            ];
        }
	}

    /**
     * 格式化字节大小
     * @param  number $size      字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     */
    protected function format_bytes($size, $delimiter = '') {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
}