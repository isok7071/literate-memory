type responseData = {
    success?: boolean,
    message?: string,
    errors?: errors[],
}

type errors = {
    string: [
        [string]
    ]
}

type userForm = {
    firstName: string,
    lastName: string,
    email: string,
    isLoading: boolean,
}
