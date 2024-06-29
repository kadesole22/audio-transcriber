import sys
import whisper

if len(sys.argv) != 2:
    print("Usage: python transcribe.py <audio_file_path>")
    sys.exit(1)
audio_file_path = sys.argv[1]

# Load the whisper model 
model = whisper.load_model("base")

# Transcribe the audio file
result = model.transcribe(audio_file_path)

# Save transcription to a file
with open("transcription.txt", "w") as f:
    f.write(result["text"])

# Print the transcription to be captured by the PHP script
print(result["text"])
