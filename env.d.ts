export {};
declare global {
  interface Window {
    AmisAdmin: AmisAdmin;
    amisRequire: any;
  }

  interface ResType<T> {
    code: number;
    data: T;
    message?: string;
    action?: "jump" | "toast" | "renderPage";
    actionType?: "url" | "route";
    url?: string;
    showMenu?: boolean;
    showHeader?: boolean;
  }

  interface AmisAdmin {
    name: string;
    title: string;
    apiBase: string;
    prefix: string;
    loginLogo: string;
    loginDesc: string;
    copyright: string;
    menu?:{
      backgroundColor?: string;
      textColor?: string;
      activeTextColor?: string;
    },
    footerLinks: {
      href: string;
      title: string;
    }[];
  }

  interface IMenu {
    id: number;
    title: string;
    key: string;
    icon: string;
    uri: string;
    uri_type: string;
    target: string;
    params: any;
    children?: IMenu[];
  }
}
