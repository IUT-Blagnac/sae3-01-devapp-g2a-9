module main {
    requires javafx.controls;
    requires javafx.fxml;
    requires json.simple;

    opens main to javafx.fxml;
    opens controller to javafx.fxml;
    exports main;
}
