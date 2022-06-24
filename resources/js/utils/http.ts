import ax, {type AxiosRequestConfig} from "axios";
import {useAmisAdminStore} from "@/stores/admin";

const {config} = useAmisAdminStore();

const axios = ax.create({
    baseURL: config.apiBase,
    timeout: 20 * 1000,
    maxBodyLength: 5 * 1024 * 1024,
    withCredentials: true,
});

axios.interceptors.request.use(
    (config: AxiosRequestConfig | any) => {
        config.params = {
            ...config.params,
        }
        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

// 添加响应拦截器
axios.interceptors.response.use(
    (response) => {
        return response;
    },
    function (error) {
        return Promise.reject(error);
    }
);


interface Http {
    get<T>(url: string, params?: unknown): Promise<T>;

    post<T>(url: string, params?: unknown): Promise<T>;

    upload<T>(url: string, params: unknown): Promise<T>;

    put<T>(url: string, params: unknown): Promise<T>;

    delete<T>(url: string, params: unknown): Promise<T>;

    download(url: string): void;
}

const http: Http = {
    get(url, params) {
        return new Promise((resolve, reject) => {
            axios
                .get(url, {params})
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    reject(err.data);
                });
        });
    },
    post(url, params) {
        return new Promise((resolve, reject) => {
            axios
                .post(url, JSON.stringify(params), {
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '',
                    }
                })
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    reject(err.data);
                });
        });
    },

    put(url, params) {
        return new Promise((resolve, reject) => {
            axios
                .put(url, JSON.stringify(params))
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    reject(err.data);
                });
        });
    },

    delete(url, params) {
        return new Promise((resolve, reject) => {
            axios
                .delete(url, {params})
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    reject(err.data);
                });
        });
    },

    upload(url, file) {
        return new Promise((resolve, reject) => {
            axios
                .post(url, file, {
                    headers: {"Content-Type": "multipart/form-data"},
                })
                .then((res) => {
                    resolve(res.data);
                })
                .catch((err) => {
                    reject(err.data);
                });
        });
    },

    download(url) {
        const iframe = document.createElement("iframe");
        iframe.style.display = "none";
        iframe.src = url;
        iframe.onload = function () {
            document.body.removeChild(iframe);
        };

        document.body.appendChild(iframe);
    },
};

export default http;
