import PortfolioData = App.Data.Portfolio.PortfolioData;
import ServiceData = App.Data.Service.ServiceData;

export type HeaderNavigationBarMenuItem = {
    icon: string | null,
    title: string,
    url: string
}

export type Breadcrumb = {
    title: string,
    url?: string | null
}

export type PaginationLink = {
    active: boolean,
    label: string,
    url?: string | null
}

export type Pagination = {
    current_page: number,
    data: Array<Object>,
    first_page_url: string,
    from: number,
    last_page: number,
    last_page_url: string,
    links: PaginationLink[],
    next_page_url: string | null,
    path: string,
    per_page: number,
    prev_page_url: string | null,
    to: number,
    total: number
}

export type PortfolioDataPaginated = {
    current_page: number,
    data: PortfolioData[],
    first_page_url: string,
    from: number,
    last_page: number,
    last_page_url: string,
    links: PaginationLink[],
    next_page_url: string | null,
    path: string,
    per_page: number,
    prev_page_url: string | null,
    to: number,
    total: number
}
