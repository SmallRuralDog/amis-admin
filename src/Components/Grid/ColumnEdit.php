<?php

namespace SmallRuralDog\AmisAdmin\Components\Grid;

trait ColumnEdit
{

    /**
     * 快捷编辑 switch 模式
     * @return Column|ColumnEdit
     */
    public function switch(): self
    {
        $this->quickEdit([
            'type' => 'switch',
            'mode' => 'inline',
            //"saveImmediately" => true,
        ])->width(50)->align('center');
        return $this;
    }

    /**
     * 快捷编辑 text 模式
     * @param bool $inline 是否行内编辑
     * @param bool $saveImmediately 是否立即保存
     * @return Column|ColumnEdit
     */
    public function inputText(bool $inline = false, bool $saveImmediately = false): self
    {
        $this->quickEdit([
            'type' => 'input-text',
            'mode' => $inline ? 'inline' : 'popover',
            "saveImmediately" => $saveImmediately,
        ]);
        return $this;
    }

    /**
     * 快捷编辑 number 模式
     * @param bool $inline 是否行内编辑
     * @param bool $saveImmediately 是否立即保存
     * @return Column|ColumnEdit
     */
    public function inputNumber(bool $inline = false, bool $saveImmediately = false): self
    {
        $this->quickEdit([
            'type' => 'input-number',
            'mode' => $inline ? 'inline' : 'popover',
            "saveImmediately" => $saveImmediately,
        ])->width(100);
        return $this;
    }
}
