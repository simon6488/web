<?php
declare(strict_types=1);

namespace App\Service;

use Hyperf\Di\Annotation\Inject;

class ExcelService
{
    private $fileName;

    private $filePath;

    private $titleConfig = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    /**
     * @Inject
     * @var \PHPExcel
     */
    private $excel;

    public function setFileName(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function setFilePath(string $filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * 设置标题
     * @param array $title
     * @return $this
     * @throws \PHPExcel_Exception
     */
    public function setTitle(array $title)
    {
        $count = sizeof($title);

        for ($i = 0; $i < $count; $i++) {
            $this->excel->setActiveSheetIndex(0)
                ->setCellValue($this->titleConfig[$i] . '1', is_array($this->titleConfig[$i]) ? $this->titleConfig[$i][0] : $this->titleConfig[$i]);

            //是否设置单元格宽度
            if (is_array($title[$i])) {
                //设置宽度
                $this->excel->getActiveSheet()->getColumnDimension($this->titleConfig[$i])->setWidth($title[$i][1]);
            } else {
                $this->excel->getActiveSheet()->getColumnDimension($this->titleConfig[$i])->setAutoSize(true);
            }

            //设置水平居中
            $this->excel->getActiveSheet()->getStyle($this->titleConfig[$i] . '1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //设置垂直居中
            $this->excel->getActiveSheet()->getStyle($this->titleConfig[$i] . '1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //设置单元格背景色
            $this->excel->getActiveSheet()->getStyle($this->titleConfig[$i] . '1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $this->excel->getActiveSheet()->getStyle($this->titleConfig[$i] . '1')->getFill()->getStartColor()->setARGB('0017C405');
        }
        return $this;
    }

    /**
     * 设置数据
     * @param array $data
     * @throws \PHPExcel_Exception
     */
    public function setData(array $data)
    {
        $num = 1;
        foreach ($data as $key => $val) {
            $num++;
            foreach ($val as $k => $v) {
                $this->excel->setActiveSheetIndex(0)
                    ->setCellValue($this->titleConfig[$k] . $num, $v);
                //设置水平居中
                $this->excel->getActiveSheet()->getStyle($this->titleConfig[$k] . $num)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //设置垂直居中
                $this->excel->getActiveSheet()->getStyle($this->titleConfig[$k] . $num)->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

                //设置自动换行
                $this->excel->getActiveSheet()->getStyle($this->titleConfig[$k] . $num)->getAlignment()->setWrapText(true);
            }

        }
        //设置表头行高
        $this->excel->getActiveSheet()->getRowDimension(1)->setRowHeight(40);
        //设置行高
        $this->excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(35);
    }

    /**
     * 导出数据
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function out()
    {
        header('Content-Type: applicationnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $this->fileName . '_' . date('Y-m-d') . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    public function read()
    {
        $ext = strtolower(pathinfo($this->filePath, PATHINFO_EXTENSION));
        if ($ext == 'xlsx') {
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
            $objPHPExcel = $objReader->load($this->filePath, 'utf-8');
        } elseif ($ext == 'xls') {
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($this->filePath, 'utf-8');
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow(); // 取得总行数
        $highestColumn = $sheet->getHighestColumn();// 取得总列
        $data = [];
        for ($i = 2; $i <= $highestRow; $i++) {
            $tmp = [];
            for ($j = 1; $j <= $highestColumn; $j++) {
                $tmp[] = $objPHPExcel->getActiveSheet()->getCell($this->titleConfig[$j] . $i)->getValue();
            }
            $data[] = $tmp;
        }
        return $data;
    }
}
