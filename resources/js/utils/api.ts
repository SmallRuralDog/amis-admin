import http from "./http";


export async function useGetMenu() {
    return await http.get<ResType<{
        active_menus: { [key: string]: string[] },
        menus: IMenu[]
    }>>("/getMenu");
}

export async function useGetToolbar() {
    return await http.get<ResType<{ left: any, right: any }>>(`/getHeaderToolbar`);
}


export async function useGetPageJson(path: string) {
    return await http.get<ResType<any>>(path);
}
