declare namespace App.Data {
export type LinkData = {
id?: number | null;
portfolioId: number;
isActive: boolean;
label: string;
href: string;
sortOrder: number;
updatedAt?: string | null;
createdAt?: string | null;
};
export type PortfolioData = {
id?: number | null;
isActive: boolean;
slug: string;
title: string;
aboutMe: string;
description: string | null;
createdAt?: string | null;
updatedAt?: string | null;
services?: Array<App.Data.ServiceData> | null;
projects?: Array<App.Data.ProjectData> | null;
links?: Array<App.Data.LinkData> | null;
};
export type ProjectCoverData = {
cover: any;
};
export type ProjectData = {
id?: number | null;
portfolioId: number;
isActive: boolean;
title: string;
description: string | null;
cover?: any | string | null;
media?: Array<any> | null;
sortOrder: number;
createdAt?: string | null;
updatedAt?: string | null;
};
export type ServiceData = {
id?: number | null;
portfolioId: number;
isActive: boolean;
title: string;
description: string | null;
price: number;
isFinalPrice: boolean;
sortOrder: number;
createdAt?: string | null;
updatedAt?: string | null;
};
}
declare namespace App.Data.Auth {
export type LoginUserData = {
email: string;
password: string;
};
export type RegisterUserData = {
username?: string;
email: string;
name: string;
password: string;
password_confirmation: string;
};
}
declare namespace App.Data.User {
export type UpdateUserData = {
name: string;
email: string;
username: string;
password: string | null;
};
export type UserData = {
id: number;
username: string;
email: string;
name: string;
};
}
declare namespace App.Enums {
export type PortfolioFilter = 'status' | 'search';
export type PortfolioStatusFilter = 'all' | 'active' | 'inactive';
}
