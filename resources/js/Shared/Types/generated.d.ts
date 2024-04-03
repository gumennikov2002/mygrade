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
declare namespace App.Data.Link {
export type LinkData = {
id: number;
portfolioId: number;
isActive: boolean;
label: string;
href: string;
sortOrder: number;
updatedAt: string;
createdAt: string;
};
export type SaveLinkData = {
portfolioId: number;
isActive: boolean;
label: string;
href: string;
sortOrder: number;
};
}
declare namespace App.Data.Portfolio {
export type PortfolioData = {
id: number;
isActive: boolean;
slug: string;
title: string;
aboutMe: string;
description: string | null;
createdAt: string | null;
updatedAt: string | null;
};
export type SavePortfolioData = {
isActive: boolean;
slug: string;
title: string;
aboutMe: string;
description: string | null;
};
}
declare namespace App.Data.Service {
export type SaveServiceData = {
portfolioId: number;
isActive: boolean;
title: string;
description: string | null;
price: number;
isFinalPrice: boolean;
sortOrder: number;
};
export type ServiceData = {
id: number;
portfolioId: number;
isActive: boolean;
title: string;
description: string | null;
price: number;
isFinalPrice: boolean;
sortOrder: number;
createdAt: string | null;
updatedAt: string | null;
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
