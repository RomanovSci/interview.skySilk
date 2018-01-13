export const rules = {
    username: {
        email: true,
    },
    password: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    },
    confirmPassword: {
        equality: "password",
    }
};