import { defineConfig, presetAttributify, presetUno } from "unocss";
import presetRemToPx from "@unocss/preset-rem-to-px";

import transformerDirectives from "@unocss/transformer-directives";
import transformerVariantGroup from "@unocss/transformer-variant-group";

import transformerCompileClass from "@unocss/transformer-compile-class";

export default defineConfig({
  presets: [
    presetUno(),
    presetAttributify(),

    presetRemToPx({
      baseFontSize: 4,
    }),
  ],
  transformers: [
    transformerDirectives(),
    transformerVariantGroup(),
    transformerCompileClass({
      classPrefix: "x-",
    }),
  ],
  theme: {
    colors: {
      primary: "#f6c620", //主题色
      info: "#24abf8", //信息色
      success: "#04d377", //成功色
      warning: "#FF8341", //警告色
      danger: "#f81900", //危险色

      hs: "#f81900", //红色
      ls: "#04d377", //绿色

      page: "#010607", //主题背景色
      card: "#171717", //卡片背景色
      block: "#363741", //区块背景色
      alert: "#FFF9F0", //警告背景色

      default: "#2D3034", //默认文字颜色
      inverse: "#ffffff", //反向文字颜色
      title: "#343434", //标题文字颜色
      muted: "#666d85", //次要文字颜色
      disabled: "#C0C4CC", //禁用文字颜色

      divider: "#333333", //分割线颜色

      background: "#dffaf6", //背景色

      gold: "#ffd438", //金币色

      tm: "transparent",
    },
  },
  rules: [
    [
      /^size-(\d+)$/,
      ([, d]) => ({ width: `${d}px`, height: `${d}px` }),
      { autocomplete: "size-<num>" },
    ],
    [
      /^title-(\d+)$/,
      ([, d]) => ({
        "font-size": `${d}px`,
        "font-weight": "bold",
        "text-transform": "capitalize",
      }),
    ],
    [
      "x-num",
      {
        "font-family": "'Barlow', sans-serif",
      },
    ],
    [
      "f-title",
      {
        "font-family": "'Inter', sans-serif",
      },
    ],
    [
      "k-title",
      {
        "font-family": "'Kanit', sans-serif",
      },
    ],
  ],
  shortcuts: {
    fc: "flex items-center",
    fsb: "flex justify-between",
    fcc: "flex items-center justify-center",
    fcb: "flex items-center justify-between",
    s0: "shrink-0",
    l0: "leading-none",
    poa: "absolute",
    centerPo: "top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2",
    pof: "fixed",
    por: "relative",
    number: "tabular-nums",
    xn: "x-num number",
    card: "bg-card rounded-8 p-10",
    tc: "text-center",
    label: "px-8 py-2 rounded-4 leading-none text-10",
    label1: "px-8 py-2 rounded-4 leading-none text-10",
    btn: "active:op-80  transition-all",
    click: "cursor-pointer active:op-80  transition-all",
    ovh: "overflow-hidden ",
    ovs: "overflow-scroll",
    input:
      "bg-#141527 rounded-8 px-10 text-14 outline-none border border-divider focus:(border-#484b85 bg-#484b85/5) transition-all",
  },
});
