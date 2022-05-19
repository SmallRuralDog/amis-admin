export {}
declare global {
    interface Window {
        AmisAdmin: AmisAdmin
        amisRequire: any
    }

    interface ResType<T> {
        code: number
        data: T
        message?: string
    }

    interface AmisAdmin {
        name: string
        title: string
        apiBase: string
        prefix: string
        loginLogo: string
        loginDesc: string
        copyright: string
        footerLinks: {
            href: string
            title: string
        }[]
    }

    interface IMenu {
        id: number
        title: string
        key: string
        icon: string
        uri: string
        uri_type: string
        target: string
        params: any
        children?: IMenu[]
    }
}

