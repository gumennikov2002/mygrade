export type HeaderNavigationBarMenuItem = {
    icon: string | null,
    title: string,
    url: string
}

export type UserRegistrationForm = {
    name: string,
    email: string,
    password: string,
    password_confirmation: string
}

export type UserLoginForm = {
    email: string,
    password: string
}

export type UserUpdateForm = {
    name: string,
    username: string,
    email: string,
    password: string | null
}

export type Portfolio = {
    id: number | null,
    isActive: boolean,
    slug: string,
    title: string,
    description: string | null,
    createdAt: string | null,
    updatedAt: string | null
}

export type Breadcrumb = {
    title: string,
    url: string | null
}
