import cv2
import sys

def filter_video(input_file, output_file):
    cap = cv2.VideoCapture(input_file)
    fourcc = cv2.VideoWriter_fourcc(*'XVID')
    out = cv2.VideoWriter(output_file, fourcc, 30.0, (640, 480))

    while cap.isOpened():
        ret, frame = cap.read()
        if not ret:
            break

        # Apply filtering logic (e.g., converting to grayscale)
        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        out.write(gray_frame)

    cap.release()
    out.release()

if __name__ == "__main__":
    filter_video(sys.argv[1], sys.argv[2])  # input and output file paths from command-line arguments
