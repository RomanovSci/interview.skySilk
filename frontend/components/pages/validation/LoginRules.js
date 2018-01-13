export const rules = {
    username: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    },
    password: {
        presence: true,
        length: {
            minimum: 1,
            message: "can't be blank",
        },
    }
};