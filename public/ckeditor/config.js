/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
    config.toolbar = [
        {
            name: "basicstyles",
            items: [
                "Bold",
                "Italic",
                "Underline",
                "Strike",
                "-",
                "RemoveFormat",
            ],
        },
        {
            name: "paragraph",
            items: [
                "NumberedList",
                "BulletedList",
                "-",
                "Outdent",
                "Indent",
                "-",
                "Blockquote",
            ],
        },
        {
            name: "align",
            items: [
                "JustifyLeft",
                "JustifyCenter",
                "JustifyRight",
                "JustifyBlock",
            ],
        },
        {
            name: "styles",
            items: ["Format", "Font", "FontSize"],
        },
        { name: "colors", items: ["TextColor", "BGColor"] },
    ];

    config.versionCheck = false;
};
