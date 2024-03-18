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
