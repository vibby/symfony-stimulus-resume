
import tailwindcssForms from "@tailwindcss/forms";
import tailwindcssTypography from "@tailwindcss/typography";

export default {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
    ],
    darkMode: "class",
    theme: {
        extend: {
            animation: {
                "spin-slow": "spin 4s linear infinite",
            },
            colors: {
                "primary-light": "#F7F8FC",
                "secondary-light": "#FFFFFF",
                "ternary-light": "#f6f7f8",

                "primary-dark": "#0D2438",
                "secondary-dark": "#102D44",
                "ternary-dark": "#1E3851",
            },
            container: {
                padding: {
                    "DEFAULT": "1rem",
                    "sm": "2rem",
                    "lg": "5rem",
                    "xl": "6rem",
                    "2xl": "8rem",
                },
            },
        },
    },
    variants: {
        extend: {
            opacity: ["disabled"],
        },
    },
    plugins: [
        tailwindcssForms,
        tailwindcssTypography
    ],
};
