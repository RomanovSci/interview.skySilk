export const rules = {
    oldPassword: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    },
    newPassword: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    },
    confirmPassword: {
        equality: "newPassword",
    }
};